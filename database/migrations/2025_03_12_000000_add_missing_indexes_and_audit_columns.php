<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds indexes and audit columns for existing databases.
     * Safe to run: skips if column/index already exists (e.g. after migrate:fresh).
     */
    public function up(): void
    {
        // interviews: add created_by, updated_by (for DBs created before this was in create_interviews)
        if (Schema::hasTable('interviews') && !Schema::hasColumn('interviews', 'created_by')) {
            Schema::table('interviews', function (Blueprint $table) {
                $table->unsignedBigInteger('created_by')->nullable()->after('follow_up_required');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
                $table->index('scheduled_date');
                $table->index('created_by');
                $table->index('updated_by');
            });
        }

        $this->safeIndex('companies', 'name', ['name']);
        $this->safeIndex('companies', 'created_by', ['created_by']);
        $this->safeIndex('companies', 'updated_by', ['updated_by']);
        $this->safeIndex('job_applications', 'application_date', ['application_date']);
        $this->safeIndex('job_applications', 'application_deadline', ['application_deadline']);
        $this->safeIndex('job_applications', 'next_follow_up_date', ['next_follow_up_date']);
        $this->safeIndex('job_applications', 'created_by', ['created_by']);
        $this->safeIndex('job_applications', 'updated_by', ['updated_by']);
        $this->safeIndex('application_status_histories', 'created_at', ['created_at']);
        $this->safeIndex('contacts', 'last_contacted_date', ['last_contacted_date']);
        $this->safeIndex('follow_ups', 'reminder_date', ['reminder_date']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('interviews', 'created_by')) {
            Schema::table('interviews', function (Blueprint $table) {
                $table->dropForeign(['created_by']);
                $table->dropForeign(['updated_by']);
                $table->dropIndex(['scheduled_date']);
                $table->dropIndex(['created_by']);
                $table->dropIndex(['updated_by']);
                $table->dropColumn(['created_by', 'updated_by']);
            });
        }

        $this->dropIndexIfExists('companies', ['name']);
        $this->dropIndexIfExists('companies', ['created_by']);
        $this->dropIndexIfExists('companies', ['updated_by']);
        $this->dropIndexIfExists('job_applications', ['application_date']);
        $this->dropIndexIfExists('job_applications', ['application_deadline']);
        $this->dropIndexIfExists('job_applications', ['next_follow_up_date']);
        $this->dropIndexIfExists('job_applications', ['created_by']);
        $this->dropIndexIfExists('job_applications', ['updated_by']);
        $this->dropIndexIfExists('application_status_histories', ['created_at']);
        $this->dropIndexIfExists('contacts', ['last_contacted_date']);
        $this->dropIndexIfExists('follow_ups', ['reminder_date']);
    }

    private function safeIndex(string $table, string $suffix, array $columns): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }
        $driver = Schema::getConnection()->getDriverName();
        $indexName = "{$table}_{$suffix}_index";
        try {
            Schema::table($table, function (Blueprint $t) use ($columns) {
                $t->index($columns);
            });
        } catch (\Throwable $e) {
            if (strpos($e->getMessage(), 'Duplicate') === false && strpos($e->getMessage(), 'already exists') === false) {
                throw $e;
            }
        }
    }

    private function dropIndexIfExists(string $table, array $columns): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }
        try {
            Schema::table($table, function (Blueprint $t) use ($columns) {
                $t->dropIndex($columns);
            });
        } catch (\Throwable $e) {
            // ignore if index doesn't exist
        }
    }
};
