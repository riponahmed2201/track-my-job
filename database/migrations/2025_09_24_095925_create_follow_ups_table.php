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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id');
            $table->unsignedBigInteger('user_id'); // Who performed the follow-up
            $table->date('follow_up_date');
            $table->string('follow_up_type', 100)->nullable(); // "Email", "Phone Call", etc.
            $table->string('contact_person')->nullable();
            $table->string('subject')->nullable();
            $table->text('message_sent')->nullable();
            $table->text('response_received')->nullable();
            $table->integer('response_time_hours')->nullable();
            $table->string('sentiment', 20)->nullable(); // "Positive", "Neutral", "Negative"
            $table->string('next_action')->nullable();
            $table->boolean('reminder_set')->default(false);
            $table->date('reminder_date')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('job_application_id')
                ->references('id')
                ->on('job_applications')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes for faster queries
            $table->index('job_application_id');
            $table->index('user_id');
            $table->index('follow_up_date');
            $table->index('completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
