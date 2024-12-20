<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    use HasFactory;

    protected $fillable =
    [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'gender',
        'profile_image',
        'date_of_birth',
        'address',
        'payment_status',
        'blood_type',
        'last_appointment_date',
        'next_appointment_date',
        // 'registered_by',
    ];

    public function patientNurces()
    {
        return $this->hasMany(PatientNurse::class);
    }
}
