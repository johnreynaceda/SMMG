<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;

class DoctorAppointment extends Component
{
    public $view_modal = false;
    public $is_collected;
    public $appointment_data;
    public $bp_attachment, $hr_attatchment, $bsc_attachment;
    public function render()
    {
        return view('livewire.doctor.doctor-appointment', [
            'appointments' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->whereHas('checkup')->get()
        ]);
    }

    public function openForm($id)
    {
        $this->appointment_data = PatientAppointment::where('id', $id)->first()->checkup;
        $this->is_collected = $this->appointment_data->blood_is_collected;
        $this->bp_attachment = $this->appointment_data->bp_attachment;
        $this->hr_attatchment = $this->appointment_data->hr_attachment;
        $this->bsc_attachment = $this->appointment_data->bsc_attachment;
        $this->view_modal = true;
    }
}