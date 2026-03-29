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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id');
            $table->integer('interview_round')->default(1);
            $table->string('interview_type', 100)->nullable(); // "Phone Screen", "Technical", etc.
            $table->string('interviewer_name')->nullable();
            $table->string('interviewer_designation')->nullable();
            $table->dateTime('scheduled_date')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->string('location')->nullable(); // "Video Call", "Phone", etc.
            $table->string('meeting_link', 500)->nullable();
            $table->string('interview_format', 50)->nullable(); // "Behavioral", "Technical", etc.
            $table->text('preparation_notes')->nullable();
            $table->text('questions_asked')->nullable();
            $table->text('my_answers')->nullable();
            $table->text('technical_topics')->nullable();
            $table->text('coding_problems')->nullable();
            $table->text('interview_feedback')->nullable();
            $table->text('interviewer_feedback')->nullable();
            $table->string('outcome', 50)->nullable(); // "Passed", "Failed", "Pending", "Rescheduled"
            $table->tinyInteger('confidence_level')->nullable(); // 1-5
            $table->tinyInteger('difficulty_level')->nullable(); // 1-5
            $table->tinyInteger('overall_experience')->nullable(); // 1-5
            $table->boolean('next_round_scheduled')->default(false);
            $table->boolean('follow_up_required')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('job_application_id')
                ->references('id')
                ->on('job_applications')
                ->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('job_application_id');
            $table->index('interview_round');
            $table->index('outcome');
            $table->index('scheduled_date');
            $table->index('created_by');
            $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
