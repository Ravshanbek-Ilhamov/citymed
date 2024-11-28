<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $services;
    public function render()
    {
        $this->services = Service::with('direction')->get();
        return view('services.index');
    }
}
