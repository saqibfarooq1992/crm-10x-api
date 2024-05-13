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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->index()->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->string('transaction_type');
            $table->string('property_Type');
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('nick_name')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('anyone_else_on_deed')->nullable();
            $table->string('date')->nullable();
            $table->string('Website')->nullable();
            $table->string('is_this_part_of_ortfolio');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
