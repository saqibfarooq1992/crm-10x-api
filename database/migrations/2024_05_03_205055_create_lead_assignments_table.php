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
        Schema::create('lead_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->index()->nullable();
            $table->json('assignment_title')->nullable();
            $table->json('assignment_name')->nullable();
            $table->json('assignment_email')->nullable();
            $table->json('assignment_phone')->nullable();
            $table->text('assignment_notes')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_assignments');
    }
};
