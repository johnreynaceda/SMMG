<?php

namespace App\Http\Livewire\Patient;

use App\Models\Notification;
use Livewire\Component;

class PatientNotification extends Component
{
    public function render()
    {
        return view('livewire.patient.patient-notification', [
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}