<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse_services extends Model
{
    public function nurse()
    {
        return $this->belongsTo(Nurse::class,'nurse_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
