<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineCategory extends Model
{
    /** @use HasFactory<\Database\Factories\MedicineCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',             // Name of the category (e.g., Painkillers, Antibiotics)
        'description',      // Optional: Additional details about the category
    ];

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
}
