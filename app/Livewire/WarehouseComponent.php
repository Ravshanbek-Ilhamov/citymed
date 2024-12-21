<?php

namespace App\Livewire;

use App\Models\Nurse;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class WarehouseComponent extends Component
{
    use WithPagination;

    public $createForm = false, $editingForm = false, $search = '', $deleteId, $nurses;
    public $selectedWarehouse = null, $name, $code, $login, $password, $capacity, $status, $note, $nurse_id = null;
    public $warehouseBeingEdited = null;
    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'nurse_id' => 'nullable|exists:nurses,id',
        'login' => 'required|string|max:255',
        'capacity' => 'nullable|numeric',
        'note' => 'nullable|string',
    ];
  
    public function render()
    {
        $warehouses = Warehouse::where('name', 'like', '%'.$this->search.'%')
                                    ->paginate(10);
        $this->nurses = Nurse::all();
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
        $this->validate([
            'password' => 'required|string|min:8',
        ]);
        Warehouse::create([
            'name' => $this->name,
            'code' => $this->code,
            'nurse_id' => $this->nurse_id,
            'login' => $this->login,
            'password' => Hash::make($this->password),
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
            $this->nurse_id = $warehouse->nurse_id;
            $this->login = $warehouse->login;
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
            'nurse_id' => $this->nurse_id,
            'login' => $this->login,
            'capacity' => $this->capacity,
            'status' => $this->status,
            'notes' => $this->note,
        ]);

        if ($this->password) {
            $this->warehouseBeingEdited->update([
                'password' => Hash::make($this->password),
            ]);
        }

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
