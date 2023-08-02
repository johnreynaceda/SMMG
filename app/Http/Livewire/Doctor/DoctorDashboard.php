<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;
use App\Models\Notification as Notif;
use Filament\Notifications\Notification;

class DoctorDashboard extends Component
{

    public function render()
    {
        return view('livewire.doctor.doctor-dashboard', [
            'appointments' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->get()->take(5),
            'todays' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->where('status', 'accepted')->whereDate('appointment_date', now())->get()->take(5),
        ]);
    }

    public function accept($id)
    {
        $appointment = PatientAppointment::where('id', $id)->first();
        Notif::create([
            'user_id' => $appointment->user->id,
            'patient_appointment_id' => $appointment->id,
            'doctor_id' => $appointment->doctor_id,
            'description' => 'Your booking for Dr. ' . $appointment->doctor->user->name . ' has been approved. See you there and be on time! ' . \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y')

        ]);
        $appointment->update([
            'status' => 'accepted',
        ]);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();

    }
}