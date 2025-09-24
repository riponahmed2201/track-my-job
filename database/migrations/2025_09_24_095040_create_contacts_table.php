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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id'); // Who added this contact
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('department', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('contact_type', 50)->nullable(); // "HR", "Recruiter", "Manager", "Employee", "Referral"
            $table->string('relationship', 100)->nullable(); // "Friend", "Colleague", "LinkedIn Connection", etc.
            $table->text('notes')->nullable();
            $table->date('last_contacted_date')->nullable();
            $table->string('response_rate', 20)->nullable(); // "High", "Medium", "Low", "No Response"
            $table->boolean('helpful')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes for faster queries
            $table->index('company_id');
            $table->index('user_id');
            $table->index('contact_type');
            $table->index('response_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
