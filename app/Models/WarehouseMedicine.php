<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseMedicine extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseMedicineFactory> */
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'medicine_id',
        'quantity',
        'date_added',
    ];
}
