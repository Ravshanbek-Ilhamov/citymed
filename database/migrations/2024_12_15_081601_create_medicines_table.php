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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('medicine_categories')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('batch_number')->unique();
            $table->integer('quantity_in_stock')->default(0);
            $table->integer('minimum_stock_level')->nullable();
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->string('manufacturer_name')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date');
            $table->float('storage_temperature')->nullable();
            $table->string('license_number')->nullable();
            $table->boolean('is_prescription_required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};