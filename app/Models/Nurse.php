<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'service_id',
        'working_hours',
        'working_days',
        'is_active',
        'profile_picture',
        'salary_type',
        'salary',
    ];
    public function services()
    {
        return $this->belongsToMany(Service::class, 'nurse_services', 'nurse_id', 'service_id');
    }

    public function patientNurse()
    {
        return $this->hasMany(PatientNurse::class);
    }
}
