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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_type')->nullable();
            $table->string('transaction_associate')->nullable();
            $table->string('assign_title')->nullable();
            $table->string('tags')->nullable();
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('n_name')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('intrusted_in_properties')->nullable();
            $table->string('preferred_contact_method')->nullable();
            $table->string('contact_source')->nullable();
            $table->text('contact_notes')->nullable();
            $table->string('attached_file')->nullable();
            $table->date('birthday')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('spouce')->nullable();
            $table->string('children_name')->nullable();
            $table->date('anniversary_date_of_purchase')->nullable();
            $table->date('anniversary_date_of_sale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
