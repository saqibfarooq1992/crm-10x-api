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
        Schema::create('advanced_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->decimal('property_value_as_is', 10, 2)->nullable();
            $table->decimal('property_value_arv_standard', 10, 2)->nullable();
            $table->decimal('property_value_arv_premium', 10, 2)->nullable();
            $table->boolean('property_taxes_current')->nullable();
            $table->enum('mortgage_payments_current', ['Yes', 'No', 'In foreclosure'])->nullable();
            $table->decimal('annual_taxes_primary_property', 10, 2)->nullable();
            $table->decimal('total_annual_taxes', 10, 2)->nullable();
            $table->string('property_tax_card')->nullable();
            $table->string('comps')->nullable();
            $table->decimal('price_min', 10, 2)->nullable();
            $table->decimal('price_max', 10, 2)->nullable();
            $table->decimal('price_per_sqft', 10, 2)->nullable();
            $table->string('comp_document')->nullable();
            $table->boolean('property_in_foreclosure')->nullable();
            $table->string('property_condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advanced_properties');
    }
};
