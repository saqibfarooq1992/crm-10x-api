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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->boolean('same_parcel')->default(true);
            $table->integer('total_bedrooms')->nullable();
            $table->integer('full_bathrooms')->nullable();
            $table->integer('half_bathrooms')->nullable();
            $table->integer('year_built')->nullable();
            $table->string('levels')->nullable();
            $table->integer('square_footage')->nullable();
            $table->integer('lot_size_sq_ft')->nullable();
            $table->text('appliances')->nullable();
            $table->boolean('fireplace')->default(false);
            $table->boolean('garage')->default(false);
            $table->integer('garage_spaces')->nullable();
            $table->string('docs_and_pics')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('electrical')->default(false);
            $table->boolean('water')->default(false);
            $table->boolean('gas')->default(false);
            $table->boolean('bathroom')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
