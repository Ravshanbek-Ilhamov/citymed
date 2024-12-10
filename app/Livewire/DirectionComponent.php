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
    public $editMode = false;
    public $showForm = false;
    public $deleteId;

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        if ($this->editMode) {
            $direction = Direction::findOrFail($this->directionId);
            $direction->update([
                'name' => $this->name,
                'is_active' => $this->is_active,
            ]);
        } else {
            Direction::create([
                'name' => $this->name,
                'is_active' => $this->is_active,
            ]);
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $direction = Direction::findOrFail($id);
        $this->directionId = $direction->id;
        $this->name = $direction->name;
        $this->is_active = $direction->is_active;
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
        $this->reset(['name', 'is_active', 'showForm', 'editMode', 'directionId']);
    }

    public function render()
    {
        $this->directions = Direction::all();
        return view('directions.index');
    }

    public function updateStatus($directionId, $isActive)
    {
        $direction = Direction::findOrFail($directionId);
        $direction->is_active = $isActive;
        $direction->save();

        session()->flash('message', 'Status updated successfully!');
    }

}
