<?php

namespace App\Livewire;

use App\Models\Worker;
use Livewire\Component;

class WorkerDetails extends Component
{

    public $worker;

    public function mount()
    {
        $workerId = session('detailing_workers');

        if ($workerId) {
            $this->worker = Worker::findOrFail($workerId);
            session()->forget('detailing_workers');
        } else {
            abort(404, 'Worker not found');
        }
    }
    public function render()
    {
        return view('workers.worker-details');
    }
}
