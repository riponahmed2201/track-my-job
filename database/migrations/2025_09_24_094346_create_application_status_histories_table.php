<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('application_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id')->nullable();
            $table->enum('previous_status', [
                'applied',
                'under_review',
                'phone_screen',
                'technical_test',
                'interview',
                'final_interview',
                'offer',
                'accepted',
                'rejected',
                'withdrawn'
            ]);
            $table->enum('new_status', [
                'applied',
                'under_review',
                'phone_screen',
                'technical_test',
                'interview',
                'final_interview',
                'offer',
                'accepted',
                'rejected',
                'withdrawn'
            ]);
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('job_application_id')->references('id')->on('job_applications')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('job_application_id');
            $table->index('previous_status');
            $table->index('new_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_status_histories');
    }
};
