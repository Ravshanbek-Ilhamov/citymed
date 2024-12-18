<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('profile_image')->nullable();
            $table->date('date_of_birth');
            $table->string('address');
            $table->boolean('payment_status')->default(false);
            $table->string('blood_type')->nullable();
            $table->dateTime('last_appointment_date')->nullable();
            $table->dateTime('next_app  ointment_time')->nullable();
            // $table->foreignId('registered_by')->constrained('registirations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
