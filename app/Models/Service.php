<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;


    protected $fillable =
    [
        'direction_id',
        'name',
        'is_active',
        'price',
    ];

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function doctor()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_services', 'service_id', 'doctor_id');
    }

    public function nurse()
    {
        return  $this->hasMany(Nurse::class);
    }

    public function patientNurces()
    {
        return $this->hasMany(PatientNurse::class);
    }

}
