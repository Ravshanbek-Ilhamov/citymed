<?php

namespace App\Livewire;

use App\Models\Direction;
use Livewire\Component;

class DirectionComponent extends Component
{
    public $directions;

    public $name;
    public $directionId;
    public $editMode = false;
    public $showForm = false;
    public $deleteId;

    public function submit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if ($this->editMode) {
            $direction = Direction::findOrFail($this->directionId);
            $direction->update([
                'name' => $this->name,
            ]);
        } else {
            Direction::create([
                'name' => $this->name,
            ]);
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $direction = Direction::findOrFail($id);
        $this->directionId = $direction->id;
        $this->name = $direction->name;
        $this->editMode = true;
        $this->showForm = true;
    }

    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $direction = Direction::findOrFail($this->deleteId);
        $direction->delete();

        session()->flash('message', 'Direction deleted successfully!');
        $this->reset(['deleteId']);
    }

    public function resetForm()
    {
        $this->reset(['name', 'showForm', 'editMode', 'directionId']);
    }

    public function render()
    {
        $this->directions = Direction::all();
        return view('directions.index');
    }

    public function updateStatus($directionId, $is_active)
    {
        $direction = Direction::findOrFail($directionId);
        $direction->update(['is_active' => $is_active]);
    
        session()->flash('message', 'Status updated successfully!');
    }

}
