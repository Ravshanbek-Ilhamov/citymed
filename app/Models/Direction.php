<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    /** @use HasFactory<\Database\Factories\DirectionFactory> */
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'is_active',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
