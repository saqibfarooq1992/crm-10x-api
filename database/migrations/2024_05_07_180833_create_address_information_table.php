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
        Schema::create('address_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->unsigned()->index()->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('county')->nullable();
            $table->string('township')->nullable();
            $table->string('subdivision')->nullable();
            $table->boolean('has_parcel')->nullable();
            $table->boolean('additional_buildings/structures')->nullable();
            $table->string('street')->nullable();
            $table->string('second_street')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_information');
    }
};
