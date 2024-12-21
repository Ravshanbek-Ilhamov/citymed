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
        Schema::create('registrators', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('email');
            $table->string('phone_number');
            $table->text('address');
            $table->string('working_hours');
            $table->boolean('is_active')->default(true);
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('working_days');
            $table->enum('salary_type', ['kpi','kpi+fixed', 'fixed']);
            $table->string('salary')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrators');
    }
};
