<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',                 // Name of the warehouse
        'code',                 // Unique identifier for the warehouse
        'login',             // Unique username for the warehouse
        'password',             // Password for the warehouse
        'capacity',             // Total capacity of the warehouse
        'nurse_id',             // ID of the nurse responsible for the warehouse
        'status',               // Operational status of the warehouse
        'notes',                // (Optional) Additional comments or notes
    ];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'warehouse_medicines', 'warehouse_id', 'medicine_id');
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }
}
