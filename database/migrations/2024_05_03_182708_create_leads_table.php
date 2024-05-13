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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            
            $table->string('leadType');
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('nick_name')->nullable();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('anyone_else_on_deed')->nullable();
            $table->string('lead_status')->nullable();
            $table->json('tags')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('property_type')->nullable();
            $table->string('residential_type')->nullable();
            $table->string('commercial_type')->nullable();
            $table->string('referral_name')->nullable();
            $table->string('referral_email')->nullable();
            $table->string('referral_number')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('county')->nullable();
            $table->string('township')->nullable();
            $table->string('subdivision')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
