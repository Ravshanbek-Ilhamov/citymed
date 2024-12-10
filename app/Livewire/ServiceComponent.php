<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Direction;
use App\Models\Doctor;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $services, $directions, $doctors, $name, $direction_id, $doctor_id, $is_active = false, $showAddForm = false;

    public function mount()
    {
        $this->directions = Direction::all();
        $this->doctors = Doctor::all(); 
    }

    public function render()
    {
        $this->services = Service::with('direction' , 'doctor')->get();
        return view('services.index');
    }

    public function toggleAddForm()
    {
        $this->resetForm();
        $this->showAddForm = !$this->showAddForm;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'direction_id' => 'required',
            'doctor_id' => 'required|integer',
        ]);

        Service::create([
            'name' => $this->name,
            'direction_id' => $this->direction_id,
            'doctor_id' => $this->doctor_id,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->showAddForm = false;
    }

    public function delete($id)
    {
        $service = Service::find($id);
        $service->delete();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->direction_id = '';
        $this->doctor_id = '';
        $this->is_active = false;
    }
}
