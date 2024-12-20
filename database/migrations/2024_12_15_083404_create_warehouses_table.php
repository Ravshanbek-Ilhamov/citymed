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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the warehouse
            $table->string('code')->unique(); // Unique identifier for the warehouse
            // $table->text('address'); // Detailed address
            $table->float('capacity')->nullable(); // Total capacity
            $table->string('manager_name')->nallable(); // Name of the manager
            $table->string('manager_contact')->nullable(); // Manager's contact
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->text('notes')->nullable(); // Additional comments or notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
