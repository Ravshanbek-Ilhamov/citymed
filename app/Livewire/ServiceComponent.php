<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Direction;
use App\Models\Doctor;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $services, $directions, $doctors, $name, $direction_id, $doctor_id, $is_active = false, $showAddForm = false, $showEditForm = false, $editingServiceId;

    public function mount()
    {
        $this->directions = Direction::all();
        $this->doctors = Doctor::all(); 
    }

    public function render()
    {
        $this->services = Service::with('direction', 'doctor')->get();
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

    public function prepareDelete($id)
    {
        $this->serviceToDelete = $id;
    }
    
    public function deleteConfirmed()
    {
        if ($this->serviceToDelete) {
            Service::find($this->serviceToDelete)->delete();
            $this->serviceToDelete = null;
            session()->flash('message', 'Service deleted successfully.');
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->editingServiceId = $service->id;
        $this->name = $service->name;
        $this->direction_id = $service->direction_id;
        $this->doctor_id = $service->doctor_id;
        $this->is_active = $service->is_active;
        $this->showEditForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'direction_id' => 'required',
            'doctor_id' => 'required|integer',
        ]);

        $service = Service::findOrFail($this->editingServiceId);
        $service->update([
            'name' => $this->name,
            'direction_id' => $this->direction_id,
            'doctor_id' => $this->doctor_id,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->showEditForm = false;
        session()->flash('message', 'Service updated successfully!');
    }

    public function resetForm()
    {
        $this->editingServiceId = null;
        $this->name = '';
        $this->direction_id = '';
        $this->doctor_id = '';
        $this->is_active = false;
    }

    public function updateStatus($serviceId, $isActive)
    {
        $service = Service::findOrFail($serviceId);
        $service->is_active = $isActive;
        $service->save();

        session()->flash('message', 'Status updated successfully!');
    }
}
