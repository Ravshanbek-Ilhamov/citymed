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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique();
            $table->string('address');
            $table->string('working_hours');
            $table->string('working_days');
            $table->boolean('is_active')->default(true);
            $table->string('profile_picture')->nullable();
            $table->string('salary_type')->nullable();
            $table->float('salary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
