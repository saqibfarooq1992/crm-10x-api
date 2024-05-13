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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            // Does Property Contain
            $table->boolean('unfinished')->nullable();
            $table->boolean('finished_basement')->nullable();
            $table->boolean('fireplace')->nullable();
            $table->boolean('fence')->nullable();
            $table->boolean('deck')->nullable();
            $table->boolean('pool_spa')->nullable();
            $table->boolean('property_floodzone_insured')->nullable();
            $table->boolean('property_floodzone_not_insured')->nullable();
            $table->enum('property_divisible', ['Yes', 'No'])->nullable();

            // Mechanical - Furnace
            $table->integer('age_of_furnace')->nullable();
            $table->enum('type_of_furnace', ['Forced Air', 'Baseboard', 'Steam', 'None'])->nullable();

            // Mechanical - Water Heater
            $table->boolean('water_heater_gas')->nullable();
            $table->boolean('water_heater_electric')->nullable();
            $table->boolean('water_heater_none')->nullable();

            // Mechanical - Air Conditioner
            $table->enum('does_air_conditioner', ['Yes', 'No'])->nullable();
            $table->json('type_of_air_conditioner')->nullable();
            $table->integer('number_of_units')->nullable();
            $table->text('air_conditioner_notes')->nullable();

            // Mechanical - Water Conditioner
            $table->enum('water_conditioner_hookup', ['Yes', 'No'])->nullable();
            $table->string('water_conditioner_city')->nullable();
            $table->string('water_conditioner_type')->nullable();
            $table->boolean('water_conditioner_rented')->nullable();
            $table->boolean('water_conditioner_purchased')->nullable();
            $table->string('water_conditioner_company')->nullable();
            $table->string('water_conditioner_phone')->nullable();
            $table->string('water_conditioner_terms_contract')->nullable();

            // Roof
            $table->integer('age_of_roof')->nullable();
            $table->json('roof_type')->nullable();
            $table->boolean('multiple_layers')->nullable();
            $table->string('condition_of_roof')->nullable();
            $table->integer('how_many')->nullable();
            $table->string('roof_company_terms_contract')->nullable();

            // Parking & Garage
            $table->enum('parking_garage', ['Garage Attached', 'Garage Detached', 'Carport', 'No Garage', 'Assigned Parking', 'Street Parking', 'Common Area Parking'])->nullable();
            $table->integer('parking_spaces')->nullable();
            $table->json('garage_dimensions')->nullable();

            // Appliances
            $table->json('appliances')->nullable();
            $table->boolean('appliances_included_in_sale')->nullable();

            // Amenities
            $table->json('amenities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
