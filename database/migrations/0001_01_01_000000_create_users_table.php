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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('n_name')->nullable();
            $table->string('title')->nullable();
            $table->date('d_o_b')->nullable();
            $table->string('state_of_license')->nullable();
            $table->string('state_license_number')->nullable();
            $table->string('industry_recognized_memberships')->nullable();
            $table->string('industry_recognized_designations')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('website')->nullable();
            $table->integer('in_business_since_year')->nullable();
            $table->string('speciality')->nullable();
            $table->text('profile_description')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('is_two_factor')->default('disabled');
            $table->string('is_verified')->default('un-verified');
            $table->string('avatar')->nullable();
            $table->string('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
