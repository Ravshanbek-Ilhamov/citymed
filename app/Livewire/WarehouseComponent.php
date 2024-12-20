<?php

namespace App\Livewire;

use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;

class WarehouseComponent extends Component
{
    use WithPagination;

    public $createForm = false, $editingForm = false, $search = '', $deleteId;
    public $selectedWarehouse = null, $name, $code, $manager_name, $manager_contact, $capacity, $status, $note;
    public $warehouseBeingEdited = null;
    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'manager_name' => 'required|string|max:255',
        'manager_contact' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        'capacity' => 'nullable',
        'note' => 'required|string|max:255',
    ];
  
    public function render()
    {
        $warehouses = Warehouse::where('name', 'like', '%'.$this->search.'%')
                                    ->orWhere('manager_name', 'like', '%'.$this->search.'%')
                                    ->paginate(10);
        return view('warehouses.warehouse-component', compact('warehouses'));
    }

    public function setDetailingWarehouse($id){
        $this->selectedWarehouse = Warehouse::findorFail($id);
    }

    public function switchWerehouseSatus($id){
        $warehouse = Warehouse::findorFail($id);
        $warehouse->status = $warehouse->status == 'active' ? 'inactive' : 'active';
        $warehouse->save();
    }



    public function store(){
        // dd($this->all());
        $this->validate();
        Warehouse::create([
            'name' => $this->name,
            'code' => $this->code,
            'manager_name' => $this->manager_name,
            'manager_contact' => $this->manager_contact,
            'capacity' => $this->capacity,
            'notes' => $this->note,
        ]);
        $this->cancel();
        session()->flash('success', 'Warehouse created successfully.');

    }

    public function SetcreateForm(){
        $this->createForm = true;
    }

    public function SeteditForm($id){
        $warehouse = Warehouse::findorFail($id);
        if ($warehouse) {
            $this->warehouseBeingEdited = $warehouse;
            $this->editingForm = true;
            $this->name = $warehouse->name;
            $this->code = $warehouse->code;
            $this->manager_name = $warehouse->manager_name;
            $this->manager_contact = $warehouse->manager_contact;
            $this->capacity = $warehouse->capacity;
            $this->status = $warehouse->status;
            $this->note = $warehouse->notes;
        }
    }

    public function update(){
        $this->validate();
        $this->warehouseBeingEdited->update([
            'name' => $this->name,
            'code' => $this->code,
            'manager_name' => $this->manager_name,
            'manager_contact' => $this->manager_contact,
            'capacity' => $this->capacity,
            'status' => $this->status,
            'notes' => $this->note,
        ]);
        $this->cancel();
        session()->flash('success', 'Warehouse updated successfully.');
    }

    public function delete($id){
        $warehouse = Warehouse::findorFail($id);
        $warehouse->delete();
        session()->flash('success', 'Warehouse deleted successfully.');
    }


    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }

    public function cancel(){
        $this->reset();

    }
}
