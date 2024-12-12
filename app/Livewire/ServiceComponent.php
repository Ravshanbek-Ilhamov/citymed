<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Direction;
use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceComponent extends Component
{

    use WithPagination;

    public $name, 
    $direction_id, 
    $showAddForm = false, $showEditForm = false, $editingServiceId , 
    $serviceToDelete , $price, $directions;

    public function mount()
    {
        $this->directions = Direction::all();
    }


    public function render()
    {
        // $this->services = Service::with('direction')->get();
        $services = Service::paginate(10);

        // dd($services);
        return view('services.index' ,['services' =>$services]);
    }

    public function toggleForm()
    {
        if ($this->showAddForm || $this->showEditForm) {
            $this->showAddForm = false;
            $this->showEditForm = false;
        } else {
            $this->showAddForm = true;
            $this->showEditForm = false;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'direction_id' => 'required',
            'price'=>'required',
        ]);

        Service::create([
            'name' => $this->name,
            'direction_id' => $this->direction_id,
            'price'=>$this->price,
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
        $this->price = $service->price;
        $this->showEditForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'direction_id' => 'required',
            'price'=>'required',
        ]);

        $service = Service::findOrFail($this->editingServiceId);
        $service->update([
            'name' => $this->name,
            'direction_id' => $this->direction_id,
            'price'=>$this->price,
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
        $this->price = '';
    }

    public function updateStatus($serviceId, $isActive)
    {
        $service = Service::findOrFail($serviceId);
        $service->is_active = $isActive;
        $service->save();

        session()->flash('message', 'Status updated successfully!');
    }
    public function backToList()
    {
        $this->showEditForm = false;
        $this->showAddForm = false;
        $this->services = Service::all(); 
    }
}
