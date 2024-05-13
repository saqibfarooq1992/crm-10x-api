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
        Schema::create('property_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->string('exterior_material')->nullable();
            $table->string('exterior_condition')->nullable();
            $table->integer('roof_age')->nullable();
            $table->string('roof_condition')->nullable();
            $table->boolean('multiple_layers')->nullable();
            $table->string('interior_condition_overall')->nullable();
            $table->string('mechanicals')->nullable();
            $table->boolean('water_softener')->nullable();
            $table->boolean('hot_water_tank')->nullable();
            $table->integer('hot_water_tank_age')->nullable();
            $table->string('appliance_quality')->nullable();
            $table->string('kitchen_quality')->nullable();
            $table->string('lot_condition')->nullable();
            $table->string('flooring_condition')->nullable();
            $table->string('fixtures_quality')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_conditions');
    }
};
