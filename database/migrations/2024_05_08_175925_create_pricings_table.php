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
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->decimal('property_value_as_is_condition')->nullable();
            $table->decimal('property_value_arv_standard')->nullable();
            $table->decimal('property_value_arv_premium')->nullable();
            $table->boolean('property_taxes_current')->nullable();
            $table->boolean('mortgage_payments_current')->nullable();
            $table->decimal('annual_taxes_for_primary_property')->nullable();
            $table->decimal('total_annual_taxes')->nullable();
            $table->string('property_tax_card')->nullable();
            $table->string('comps')->nullable();
            $table->decimal('price_min')->nullable();
            $table->decimal('price_max')->nullable();
            $table->decimal('price_per_sqft')->nullable();
            $table->string('comp_document_uploaded')->nullable();
            $table->boolean('property_foreclosure_status')->nullable();
            $table->string('pricing_property_condition')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
