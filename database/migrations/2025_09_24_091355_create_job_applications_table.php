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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('job_title', 255);
            $table->longText('job_description');
            $table->string('job_url', 500)->nullable();
            $table->integer('salary_range_min')->nullable();
            $table->integer('salary_range_max')->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('location')->nullable();
            $table->string('work_type')->nullable();
            $table->string('employment_type')->nullable();
            $table->date('application_date')->nullable();
            $table->date('application_deadline')->nullable();
            $table->enum('application_status', [
                'applied', // Initial application submitted
                'under_review', // Application is being reviewed by the employer
                'phone_screen', // Phone screening stage
                'technical_test', // Technical test or assessment stage
                'interview', // General interview stage
                'final_interview', // Final interview stage
                'offer', // Job offer received
                'accepted', // Offer accepted
                'rejected', // Application rejected
                'withdrawn' // Application withdrawn by the applicant
            ])->default('applied');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->string('source')->nullable();
            $table->string('referral_contact')->nullable();
            $table->boolean('cover_letter_sent')->default(false);
            $table->boolean('portfolio_sent')->default(false);
            $table->integer('expected_salary')->nullable();
            $table->string('notice_period')->nullable();
            $table->text('notes')->nullable();
            $table->date('last_follow_up_date')->nullable();
            $table->date('next_follow_up_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('user_id');
            $table->index('company_id');
            $table->index('application_status');
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
