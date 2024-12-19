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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');              // Supplier's firstname
            $table->string('last_name');               // Supplier's lastname
            $table->string('email')->unique();   // Email must be unique
            $table->string('phone_number')->unique();   // Phone must be unique
            $table->text('address');             // Full address
            $table->string('company_name');      // Name of the company
            $table->string('country');           // Country of operation
            $table->string('contact_person');    // Contact person's name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
