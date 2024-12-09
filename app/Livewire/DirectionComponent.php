<?php

namespace App\Livewire;

use App\Models\Direction;
use Livewire\Component;

class DirectionComponent extends Component
{
    public $directions;

    public $name;
    public $is_active = true;
    public $directionId;

    public function submit()
    {
        $this->validate([
            'name'=>'required',
            'is_active'=>'required|boolean',
        ]);

        Direction::create([
            'name'=>$this->name,
            'is_active'=>$this->is_active,
        ]);
        $this->dispatch('hideCreateModel');
    }

    public function edit($id)
    {
        $direction = Direction::find($id);
        $this->name = $direction->name;
        $this->is_active = $direction->is_active;
        $this->directionId = $id;
    
        // Use dispatch() method
        $this->dispatch('showEditModal');
    }
    
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'is_active' => 'required|boolean'
        ]);
    
        $direction = Direction::find($this->directionId);
        $direction->name = $this->name;
        $direction->is_active = $this->is_active;
        $direction->save();
    
        // Reset fields
        $this->reset(['name', 'is_active', 'directionId']);
    
        $this->dispatch('hideEditModal');
    }
    public function delete($id)
    {
        $direction = Direction::findOrFail($id);
        $direction->delete();

        session()->flash('message', 'Direction deleted successfully!');
    }
    public function render()
    {
        $this->directions = Direction::all();
        return view('directions.index');
    }
}
