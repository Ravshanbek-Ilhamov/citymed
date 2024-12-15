<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class SelectComponent extends Component
{
    public function render()
    {
        return view('livewire.select-component');
    }

    public $selectedCategories = [];
    public $categories = [];

    public function mount()
    {
        // Fetch available categories
        $this->categories = Service::all();
    }

    public function updatedSelectedCategories()
    {
        // Optional: Add any logic you want to run when selections change
        $this->dispatchBrowserEvent('categories-updated', $this->selectedCategories);
    }

    public function saveSelection()
    {
        $this->validate([
            'selectedCategories' => 'required|array|min:1'
        ]);

        // Logic to save selected categories
        // For example, if you're attaching to a model:
        // $model->categories()->sync($this->selectedCategories);

        session()->flash('message', 'Categories successfully updated.');
    }
}

