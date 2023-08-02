<?php

namespace App\Http\Livewire\Nurse;

use App\Models\PatientAppointment;
use App\Models\User;
use Livewire\Component;

class NurseDashboard extends Component
{
    public function render()
    {
        return view('livewire.nurse.nurse-dashboard', [
            'patients' => User::where('account_type', 'patient')->get(),
            'visits' => User::whereDate('created_at', now())->count(),
            'new' => PatientAppointment::whereDate('created_at', '<=', now())->whereDate('created_at', '>=', now()->subDays(5))->count(),
            'old' => PatientAppointment::whereDate('created_at', '<=', now()->subDays(5))->count(),
        ]);
    }
}