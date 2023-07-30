<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;
use Filament\Notifications\Notification;

class DoctorDashboard extends Component
{

    public function render()
    {
        return view('livewire.doctor.doctor-dashboard', [
            'appointments' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->get()->take(5),
            'todays' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->where('status', 'accepted')->get()->take(5),
        ]);
    }

    public function accept($id)
    {
        $appointment = PatientAppointment::where('id', $id)->first();
        $appointment->update([
            'status' => 'accepted',
        ]);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();

    }
}