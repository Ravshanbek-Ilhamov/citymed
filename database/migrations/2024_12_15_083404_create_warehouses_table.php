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
            $table->string('name');                     // Name of the warehouse
            $table->string('code')->unique();           // Unique warehouse code
            $table->text('address');                    // Detailed address
            $table->integer('capacity');                // Total capacity of the warehouse
            $table->integer('current_usage')->default(0); // Current inventory load (default 0)
            $table->string('manager_name');             // Name of the warehouse manager
            $table->string('manager_contact');          // Contact details of the manager
            $table->enum('status', ['active', 'inactive', 'under_maintenance']) // Operational status
                  ->default('active');
            $table->boolean('temperature_control')->default(false); // Temperature control (default false)
            $table->enum('security_level', ['low', 'medium', 'high'])->default('medium'); // Security level
            $table->text('special_features')->nullable(); // Special features like cold storage
            $table->text('notes')->nullable();            // Additional comments or notes
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
