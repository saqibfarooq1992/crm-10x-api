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
        Schema::create('lead_requirements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->index()->nullable();
            $table->string('price_range_min')->nullable();
            $table->string('price_range_max')->nullable();

            $table->string('expected_listing_price')->nullable();
            $table->string('square_footage')->nullable();

            $table->string('lot_size')->nullable();
            $table->string('property_details')->nullable();

            $table->string('comps')->nullable();
            $table->string('seller_price_max')->nullable();
            $table->string('seller_price_min')->nullable();

            $table->string('price_per_sqrFT')->nullable();
            $table->string('seller_comps_file')->nullable();

            $table->string('desired_square_footage_min')->nullable();
            $table->string('desired_square_footage_max')->nullable();
            $table->string('desired_lot_size_min')->nullable();
            $table->string('desired_lot_size_max')->nullable();
            $table->string('is_investment')->nullable();
            $table->string('financing_cash')->nullable();
            $table->string('pre_approved')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_requirements');
    }
};
