<?php

namespace App\Livewire;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineComponent extends Component
{
    use WithPagination;
    public $createForm = false, $editingForm = false;
    public $categories,$suppliers,$search = '';
    public $medicineBeingEdited, $name,$category_id,$description,$batch_number,$quantity_in_stock,$minimum_stock_level,$purchase_price,
            $selling_price,$discount,$supplier_id,$manufacturer_name,$country_of_origin,
            $manufacture_date,$expiry_date,$storage_temperature,$license_number,
            $is_prescription_required,$deleteId;


    public $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:medicine_categories,id',
        'description' => 'nullable|string',
        'batch_number' => 'nullable|string|max:100|unique:medicines,batch_number',
        'quantity_in_stock' => 'required|integer|min:0',
        'minimum_stock_level' => 'required|integer|min:0',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0|max:100',
        'supplier_id' => 'nullable|integer|exists:suppliers,id',
        'manufacturer_name' => 'nullable|string|max:255',
        'country_of_origin' => 'nullable|string|max:100',
        'manufacture_date' => 'nullable|date|before_or_equal:today',
        'expiry_date' => 'nullable|date|after:manufacture_date',
        'storage_temperature' => 'nullable|numeric',
        'license_number' => 'nullable|string|max:100',
        'is_prescription_required' => 'required|boolean',
    ];
    public function render()
    {
        $medicines = Medicine::where('name', 'like', '%' . $this->search . '%')
                                ->paginate(10);

        $this->categories = MedicineCategory::all();
        $this->suppliers = Supplier::all();
        return view('medicines.index', ['medicines' => $medicines]);
    }


    public function SetDeatailingMedicine($medicine)
    {
        // $this->editingForm = true;
        // $this->medicine = $medicine;    
    }


    public function SetcreateForm()
    {
        $this->createForm = true;
    }

    public function SeteditForm(Medicine $medicine)
    {

        $this->editingForm = true;
        $this->medicineBeingEdited = $medicine;
        $this->name = $medicine->name;
        $this->category_id = $medicine->category_id;
        $this->description = $medicine->description;
        // $this->batch_number = $medicine->batch_number;
        $this->quantity_in_stock = $medicine->quantity_in_stock;
        $this->minimum_stock_level = $medicine->minimum_stock_level;
        $this->purchase_price = $medicine->purchase_price;
        $this->selling_price = $medicine->selling_price;
        $this->discount = $medicine->discount;
        $this->supplier_id = $medicine->supplier_id;
        $this->manufacturer_name = $medicine->manufacturer_name;
        $this->country_of_origin = $medicine->country_of_origin;
        $this->manufacture_date = $medicine->manufacture_date;
        $this->expiry_date = $medicine->expiry_date;
        $this->storage_temperature = $medicine->storage_temperature;
        $this->license_number = $medicine->license_number;
        $this->is_prescription_required = $medicine->is_prescription_required;

    }

    public function update(){

        $this->validate();
        $this->medicineBeingEdited->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'quantity_in_stock' => $this->quantity_in_stock,
            'is_prescription_required' => $this->is_prescription_required,
            'minimum_stock_level' => $this->minimum_stock_level,
            'selling_price' => $this->selling_price,
            'purchase_price' => $this->purchase_price,
            'supplier_id' => $this->supplier_id,
            'discount' => $this->discount,
            'country_of_origin' => $this->country_of_origin,
            'manufacturer_name' => $this->manufacturer_name,
            'manufacture_date' => $this->manufacture_date,
            'expiry_date' => $this->expiry_date,
            'storage_temperature' => $this->storage_temperature,
            'license_number' => $this->license_number,
            'description' => $this->description,
        ]);

        if($this->batch_number){
            $this->medicineBeingEdited->update([
                'batch_number' => $this->batch_number
            ]);
        }

        $this->cancel();
        session()->flash('message', 'Medicine updated successfully!');
    }


    public function store(){

        $this->validate();
        Medicine::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'quantity_in_stock' => $this->quantity_in_stock,
            'is_prescription_required' => $this->is_prescription_required,
            'batch_number' => $this->batch_number,
            'minimum_stock_level' => $this->minimum_stock_level,
            'selling_price' => $this->selling_price,
            'purchase_price' => $this->purchase_price,
            'supplier_id' => $this->supplier_id,
            'discount' => $this->discount,
            'country_of_origin' => $this->country_of_origin,
            'manufacturer_name' => $this->manufacturer_name,
            'manufacture_date' => $this->manufacture_date,
            'expiry_date' => $this->expiry_date,
            'storage_temperature' => $this->storage_temperature,
            'license_number' => $this->license_number,
            'description' => $this->description,
        ]);

        $this->cancel();
        session()->flash('message', 'Medicine created successfully!');
    }

    public function delete($id){
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        session()->flash('message', 'Medicine deleted successfully!');
    }

    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }



    public function cancel()
    {
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }
}