<?php

namespace App\Livewire;

use App\Models\Medicine;
use App\Models\Warehouse;
use App\Models\WarehouseMedicine;
use Livewire\Component;

class DistributeWarehouseComponent extends Component
{

    public $warehouse, $warehouses,$medicines;
    public $name, $warehouse_id,$medicine_id,$quantity, $maxValue;

    protected function rules()
    {
        return [
            'warehouse_id' => 'required',
            'medicine_id' => 'required',
            'quantity' => 'required|integer|min:1|max:'.$this->maxValue,
        ];
    }


    public function mount($id)
    {
        $this->warehouse = Warehouse::findorFail($id);
        $this->name = $this->warehouse->name;
        $this->warehouses = Warehouse::where('id','!=', $this->warehouse->id)->get();
        $this->medicines = $this->warehouse->medicines;
    }   

    public function render()
    {
        return view('admin-page.warehouses.distribute-warehouse-component');
    }

    public function medicineSelected($id){
        $this->maxValue = WarehouseMedicine::where('warehouse_id', $this->warehouse->id)->where('medicine_id', $id)->first()->quantity ?? 0;
    }
        

    public function distribute(){

        $this->validate($this->rules());

        $warehouse = Warehouse::findorFail($this->warehouse_id);

        $warehouseMedicine = WarehouseMedicine::where('warehouse_id', $this->warehouse->id)->where('medicine_id', $this->medicine_id)->first();
        $warehouseMedicine->quantity = $warehouseMedicine->quantity - $this->quantity;
        $warehouseMedicine->save();

        if (WarehouseMedicine::where('warehouse_id', $this->warehouse_id)->where('medicine_id', $this->medicine_id)->first()) {
            $warehouseMedicine = WarehouseMedicine::where('warehouse_id', $this->warehouse_id)->where('medicine_id', $this->medicine_id)->first();
            $warehouseMedicine->quantity = $warehouseMedicine->quantity + $this->quantity;
            $warehouseMedicine->save();
        }else{
            $warehouse->medicines()->attach($this->medicine_id, [
                'quantity' => $this->quantity,
                'date_added' => now(),
            ]);
        }

        $this->redirect("/warehouses",navigate: true);
    }

    public function cancel(){
        return $this->redirect("/warehouses",navigate: true);
    } 
}
