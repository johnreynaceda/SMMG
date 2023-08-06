<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;
use App\Models\Notification as Notif;
use Filament\Notifications\Notification;

class DoctorDashboard extends Component
{
    public $view_modal = false;
    public $appointment_data = [];

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

        // $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
        // $sender = 'SEMAPHORE';
        // $ch = curl_init();
        // $parameters = [
        //     'apikey' => $api_key,
        //     'number' => $this->phone_number,
        //     'message' => 'Dear User, Your Appointment for Dr.' . $appointment->doctor->user->name . ' has been approved.' . 'See you there and be on time! ' . \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') . ' Thank you for using our service.',
        //     'sendername' => $sender,
        // ];
        // curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($ch);
        // curl_close($ch);
        // return $output;
    }

    public function openRequest($id)
    {

        $this->appointment_data = PatientAppointment::where('id', $id)->first();
        $this->view_modal = true;
    }

    public function decline($id)
    {
        $patient = PatientAppointment::where('id', $id)->first();
        $patient->update([
            'status' => 'declined',
        ]);
        Notification::make()
            ->title('Declined successfully')
            ->success()
            ->send();
        $this->view_modal = false;

        // $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
        // $sender = 'SEMAPHORE';
        // $ch = curl_init();
        // $parameters = [
        //     'apikey' => $api_key,
        //     'number' => $this->phone_number,
        //     'message' => 'Dear User, Your Appointment for Dr.' . $patient->doctor->user->name . ' has been declined.' . 'Please try to book again. Thank you for using our service.',
        //     'sendername' => $sender,
        // ];
        // curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($ch);
        // curl_close($ch);
        // return $output;
    }
}