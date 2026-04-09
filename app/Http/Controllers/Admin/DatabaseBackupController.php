<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DatabaseBackupController extends Controller
{
    private const BACKUP_DIR = 'database-backups';

    public function index()
    {
        $disk = Storage::disk('local');
        $files = collect($disk->files(self::BACKUP_DIR))
            ->filter(fn (string $path) => str_ends_with($path, '.sql'))
            ->map(function (string $path) use ($disk): array {
                return [
                    'path' => $path,
                    'file' => basename($path),
                    'size' => $disk->size($path),
                    'last_modified' => $disk->lastModified($path),
                ];
            })
            ->sortByDesc('last_modified')
            ->values();

        return view('admin.database-backups.index', compact('files'));
    }

    public function store()
    {
        $connection = DB::connection();
        $driver = $connection->getDriverName();

        if (! in_array($driver, ['mysql', 'sqlite'], true)) {
            return back()->with('error', "Backup is not supported for '{$driver}' driver yet.");
        }

        $filename = now()->format('Ymd_His').'_'.config('database.default').'_backup.sql';
        $path = self::BACKUP_DIR.'/'.$filename;

        $dump = $driver === 'mysql'
            ? $this->buildMysqlDump()
            : $this->buildSqliteDump();

        Storage::disk('local')->put($path, $dump);

        return back()->with('success', "Database backup created: {$filename}");
    }

    public function download(string $file): BinaryFileResponse|StreamedResponse
    {
        $this->ensureSafeFilename($file);

        $path = self::BACKUP_DIR.'/'.$file;
        abort_unless(Storage::disk('local')->exists($path), 404);

        return response()->download(
            storage_path('app/private/'.$path),
            $file,
            ['Content-Type' => 'application/sql']
        );
    }

    public function destroy(string $file)
    {
        $this->ensureSafeFilename($file);

        $path = self::BACKUP_DIR.'/'.$file;
        $disk = Storage::disk('local');
        abort_unless($disk->exists($path), 404);

        $disk->delete($path);

        return back()->with('success', 'Backup deleted successfully.');
    }

    private function ensureSafeFilename(string $file): void
    {
        abort_unless((bool) preg_match('/^[A-Za-z0-9._-]+$/', $file), 404);
    }

    private function buildMysqlDump(): string
    {
        $connection = DB::connection();
        $pdo = $connection->getPdo();
        $lines = [
            '-- Track My Job database backup',
            '-- Generated at: '.now()->toDateTimeString(),
            '-- Driver: mysql',
            '',
            'SET FOREIGN_KEY_CHECKS=0;',
            'START TRANSACTION;',
            '',
        ];

        $tables = $connection->select('SHOW TABLES');
        $tableNames = array_map(
            fn ($row) => array_values((array) $row)[0],
            $tables
        );

        foreach ($tableNames as $table) {
            $quotedTable = '`'.str_replace('`', '``', (string) $table).'`';
            $create = (array) $connection->selectOne("SHOW CREATE TABLE {$quotedTable}");
            $createSql = (string) (array_values($create)[1] ?? '');

            if ($createSql === '') {
                continue;
            }

            $lines[] = "-- Table structure for {$table}";
            $lines[] = "DROP TABLE IF EXISTS {$quotedTable};";
            $lines[] = $createSql.';';
            $lines[] = '';

            $rows = $connection->table($table)->get();
            if ($rows->isEmpty()) {
                continue;
            }

            $columns = array_keys((array) $rows->first());
            $quotedColumns = implode(', ', array_map(
                fn ($column) => '`'.str_replace('`', '``', $column).'`',
                $columns
            ));

            foreach ($rows as $row) {
                $values = [];
                foreach ($columns as $column) {
                    $value = $row->{$column};
                    if ($value === null) {
                        $values[] = 'NULL';
                    } elseif (is_bool($value)) {
                        $values[] = $value ? '1' : '0';
                    } elseif (is_int($value) || is_float($value)) {
                        $values[] = (string) $value;
                    } else {
                        $values[] = $pdo->quote((string) $value);
                    }
                }

                $lines[] = "INSERT INTO {$quotedTable} ({$quotedColumns}) VALUES (".implode(', ', $values).');';
            }

            $lines[] = '';
        }

        $lines[] = 'COMMIT;';
        $lines[] = 'SET FOREIGN_KEY_CHECKS=1;';
        $lines[] = '';

        return implode("\n", $lines);
    }

    private function buildSqliteDump(): string
    {
        $connection = DB::connection();
        $pdo = $connection->getPdo();
        $lines = [
            '-- Track My Job database backup',
            '-- Generated at: '.now()->toDateTimeString(),
            '-- Driver: sqlite',
            '',
            'PRAGMA foreign_keys=OFF;',
            'BEGIN TRANSACTION;',
            '',
        ];

        $tables = $connection->select("
            SELECT name, sql
            FROM sqlite_master
            WHERE type='table' AND name NOT LIKE 'sqlite_%'
            ORDER BY name
        ");

        foreach ($tables as $tableMeta) {
            $table = (string) $tableMeta->name;
            $createSql = (string) $tableMeta->sql;
            if ($createSql === '') {
                continue;
            }

            $quotedTable = '"'.str_replace('"', '""', $table).'"';
            $lines[] = "-- Table structure for {$table}";
            $lines[] = "DROP TABLE IF EXISTS {$quotedTable};";
            $lines[] = $createSql.';';
            $lines[] = '';

            $rows = $connection->table($table)->get();
            if ($rows->isEmpty()) {
                continue;
            }

            $columns = array_keys((array) $rows->first());
            $quotedColumns = implode(', ', array_map(
                fn ($column) => '"'.str_replace('"', '""', $column).'"',
                $columns
            ));

            foreach ($rows as $row) {
                $values = [];
                foreach ($columns as $column) {
                    $value = $row->{$column};
                    if ($value === null) {
                        $values[] = 'NULL';
                    } elseif (is_bool($value)) {
                        $values[] = $value ? '1' : '0';
                    } elseif (is_int($value) || is_float($value)) {
                        $values[] = (string) $value;
                    } else {
                        $values[] = $pdo->quote((string) $value);
                    }
                }

                $lines[] = "INSERT INTO {$quotedTable} ({$quotedColumns}) VALUES (".implode(', ', $values).');';
            }

            $lines[] = '';
        }

        $lines[] = 'COMMIT;';
        $lines[] = 'PRAGMA foreign_keys=ON;';
        $lines[] = '';

        return implode("\n", $lines);
    }
}

