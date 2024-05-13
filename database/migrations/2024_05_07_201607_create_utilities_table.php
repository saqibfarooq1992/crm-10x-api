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
        Schema::create('utilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('electrical_provider')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('standard_single_phase_service')->nullable();
            $table->boolean('230_volt_three_phase_power')->nullable();
            $table->boolean('460_volt_three_phase_power')->nullable();
            $table->boolean('575_volt_three_phase_power')->nullable();
            $table->enum('solar', ['Yes', 'No'])->nullable();
            $table->enum('electric_generator', ['Yes', 'No'])->nullable();
            $table->boolean('gas')->nullable();
            $table->boolean('propane_or_the_like')->nullable();
            $table->boolean('is_tank_rented')->nullable();
            $table->boolean('no_gas')->nullable();
            $table->boolean('well')->nullable();
            $table->boolean('city_water')->nullable();
            $table->boolean('septic')->nullable();
            $table->boolean('sewer')->nullable();
            $table->boolean('trash_cost_included_with_county_taxes')->nullable();
            $table->string('trash_company_provider')->nullable();
            $table->string('trash_company_phone')->nullable();
            $table->string('gas_provider_name')->nullable();
            $table->string('gas_provider_phone')->nullable();
            $table->string('propane_provider_name')->nullable();
            $table->string('propane_provider_phone')->nullable();
            $table->string('water_provider_name')->nullable();
            $table->string('water_provider_phone')->nullable();
            $table->string('sewer_company_name')->nullable();
            $table->string('sewer_company_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities');
    }
};
