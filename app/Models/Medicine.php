<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    /** @use HasFactory<\Database\Factories\MedicineFactory> */
    use HasFactory;

    protected $fillable = [
        'name',                 // Name of the medicine
        'category_id',          // Foreign key for the category of the medicine
        'description',          // Detailed information about the medicine
        'batch_number',         // Unique batch identifier
        'quantity_in_stock',    // Current stock level
        'minimum_stock_level',  // Alert threshold for low stock
        'purchase_price',       // Cost price of the medicine
        'selling_price',        // Price at which it is sold
        'discount',             // Applicable discount
        'supplier_id',          // Foreign key for supplier details
        'manufacturer_name',    // Name of the manufacturer
        'country_of_origin',    // Country where it is produced
        'manufacture_date',     // Date of production
        'expiry_date',          // Expiry date for shelf life
        'storage_temperature',  // Ideal storage temperature
        'license_number',       // Regulatory license number
        'is_prescription_required', // Boolean to indicate if a prescription is needed
    ];

    public function category()
    {
        return $this->belongsTo(MedicineCategory::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
