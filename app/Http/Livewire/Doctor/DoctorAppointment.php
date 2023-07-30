<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;

class DoctorAppointment extends Component
{
    public function render()
    {
        return view('livewire.doctor.doctor-appointment', [
            'appointments' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->get()
        ]);
    }
}
