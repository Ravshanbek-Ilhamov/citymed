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
        'current_usage',        // Current usage or inventory load
        'manager_name',         // Name of the warehouse manager
        'manager_contact',      // Contact details of the manager
        'status',               // Operational status of the warehouse
        'temperature_control',  // (Optional) Whether the warehouse has temperature control
        'security_level',       // (Optional) Security level of the warehouse
        'special_features',     // (Optional) Special features like cold storage
        'notes',                // (Optional) Additional comments or notes
    ];
    
}
