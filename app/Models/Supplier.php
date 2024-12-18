<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',                // Name of the supplier
        'last_name',                 // Last name of the supplier
        'email',               // Email address of the supplier
        'phone_number',               // Phone number for contact
        'address',             // Supplier's address
        'company_name',        // Company the supplier represents
        'country',             // Supplier's country of origin
        'contact_person',      // Name of the main contact person
    ];

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
    
}
