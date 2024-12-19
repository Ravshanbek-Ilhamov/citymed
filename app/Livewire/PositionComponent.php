<?php

namespace App\Livewire;

use App\Models\Position;
use Livewire\Component;

class PositionComponent extends Component
{
    public $positions;

    public $name;
    public $positionId;
    public $editMode = false;
    public $showForm = false;
    public $deleteId;

    public function submit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if ($this->editMode) {
            $position = Position::findOrFail($this->positionId);
            $position->update([
                'name' => $this->name,
            ]);
        } else {
            Position::create([
                'name' => $this->name,
            ]);
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $this->positionId = $position->id;
        $this->name = $position->name;
        $this->editMode = true;
        $this->showForm = true;
    }

    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $position = Position::findOrFail($this->deleteId);
        $position->delete();

        session()->flash('message', 'Position deleted successfully!');
        $this->reset(['deleteId']);
    }

    public function resetForm()
    {
        $this->reset(['name', 'showForm', 'editMode', 'positionId']);
    }

    public function render()
    {
        $this->positions = Position::all();
        return view('positions/index');
    }

    public function updateStatus($positionId, $is_active)
    {
        $position = Position::findOrFail($positionId);
        $position->update(['is_active' => $is_active]);

        session()->flash('message', 'Status updated successfully!');
    }
}
