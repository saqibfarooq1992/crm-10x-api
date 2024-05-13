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
        Schema::create('address_additional_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('address_id')->unsigned()->index()->nullable();
            $table->string('property_images');
            $table->string('APN_State')->nullable(); // Changed column name
            $table->string('legal_description')->nullable();
            $table->string('gis_url')->nullable();
            $table->string('google_map_url')->nullable();
            $table->foreign('address_id')->references('id')->on('address_information')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_additional_information');
    }
};
