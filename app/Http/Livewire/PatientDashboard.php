<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class PatientDashboard extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.patient-dashboard', [
            'doctors' => Doctor::paginate(6),
        ]);
    }
}