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
        'address',              // Detailed address of the warehouse
        'capacity',             // Total capacity of the warehouse
        'manager_name',         // Name of the warehouse manager
        'manager_contact',      // Contact details of the manager
        'status',               // Operational status of the warehouse
        'notes',                // (Optional) Additional comments or notes
    ];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'warehouse_medicines', 'warehouse_id', 'medicine_id');
    }
    
}
