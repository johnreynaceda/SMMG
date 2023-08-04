<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\PatientAppointment as Appointment;

class PatientAppointment extends Component
{
    public $view_modal = false;
    public $is_collected;
    public $appointment_data;
    public $bp_attachment, $hr_attatchment, $bsc_attachment;
    public function render()
    {
        return view('livewire.patient.patient-appointment', [
            'appointments' => Appointment::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function openForm($id)
    {
        $this->appointment_data = Appointment::where('id', $id)->first()->checkup;
        $this->is_collected = $this->appointment_data->blood_is_collected;
        $this->bp_attachment = $this->appointment_data->bp_attachment;
        $this->hr_attatchment = $this->appointment_data->hr_attachment;
        $this->bsc_attachment = $this->appointment_data->bsc_attachment;
        $this->view_modal = true;
    }
}