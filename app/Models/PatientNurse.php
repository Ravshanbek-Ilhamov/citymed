<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientNurse extends Model
{
    /** @use HasFactory<\Database\Factories\PatientNurseFactory> */
    use HasFactory;


    protected $fillable = [
        'patient_id',
        'service_id',
        'nurse_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
