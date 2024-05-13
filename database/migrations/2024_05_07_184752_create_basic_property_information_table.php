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
        Schema::create('basic_property_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->unsigned()->index()->nullable();
            $table->string('total_square_footage_of_primary_home')->nullable();
            $table->string('acreage_of_primary_property')->nullable();
            $table->string('architectural_style')->nullable();
            $table->string('year_build')->nullable();
            $table->string('number_of_bedrooms')->nullable();
            $table->string('number_of_full_bathrooms')->nullable();
            $table->string('number_of_half_bathrooms')->nullable();
            $table->string('levels')->nullable();
            $table->string('foundation')->nullable();
            $table->string('waterfront')->nullable();
            $table->boolean('is_property_part_of_HOA')->nullable();
            $table->text('assign_HOA')->nullable();
            $table->string('attach_PDF_HOA_documents')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_property_information');
    }
};
