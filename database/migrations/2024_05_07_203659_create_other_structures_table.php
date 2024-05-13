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
        Schema::create('other_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('building_label')->nullable();
            $table->integer('year_built')->nullable();
            $table->integer('square_footage')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->string('flood_zone')->nullable();
            $table->text('roof_type')->nullable();
            $table->string('roof_condition')->nullable();
            $table->text('interior_material')->nullable();
            $table->string('interior_condition')->nullable();
            $table->text('exterior_material')->nullable();
            $table->string('exterior_condition')->nullable();
            $table->string('electricity_available')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_structures');
    }
};
