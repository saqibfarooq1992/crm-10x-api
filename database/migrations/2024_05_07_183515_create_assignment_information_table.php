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
        Schema::create('assignment_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->unsigned()->index()->nullable();
            $table->json('assignment_title')->nullable();
            $table->json('assignment_name')->nullable();
            $table->json('assignment_email')->nullable();
            $table->json('assignment_phone')->nullable();
            $table->string('assign_signs')->nullable();
            $table->string('assign_lockbox')->nullable();
            $table->string('assign_header')->nullable();
            $table->string('assign_banner')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_information');
    }
};
