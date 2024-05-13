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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contact_id')->unsigned()->index()->nullable();
            $table->string('name');
            $table->string('assign_to_agent');
            $table->date('start_date');
            $table->date('deadline_date');
            $table->string('type');
            $table->string('priority');
            $table->text('description');
            $table->json('tags');
            $table->json('repeat')->nullable();
            $table->string('task_reminder');
            $table->boolean('monday');
            $table->boolean('tuesday');
            $table->boolean('wednesday');
            $table->boolean('thursday');
            $table->boolean('friday');
            $table->boolean('saturday');
            $table->boolean('sunday');
            $table->date('end_on_date')->nullable();
            $table->string('year_date_range')->nullable(); // Assuming monthly repeat with day of the month
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
