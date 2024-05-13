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
        Schema::create('document_note_and_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('building_layout_file')->nullable();
            $table->string('environmental_reports_file')->nullable();
            $table->string('inspection_reports_file')->nullable();
            $table->string('traffic_count_file')->nullable();
            $table->string('offering_memorandum_file')->nullable();
            $table->text('notes')->nullable();
            $table->date('effective_listing_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->integer('days_required_to_list_by_mls')->nullable();
            $table->text('public_remarks')->nullable();
            $table->text('private_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_note_and_remarks');
    }
};
