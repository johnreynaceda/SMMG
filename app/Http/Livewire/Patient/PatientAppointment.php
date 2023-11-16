<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\PatientAppointment as Appointment;
use WireUi\Traits\Actions;
use App\Models\Notification as Notif;

class PatientAppointment extends Component
{
    use Actions;
    public $view_modal = false;
    public $reschedule_modal = false;
    public $appointment_id;
    public $is_collected;
    public $reason;
    public $appointment_data;

    public $bp_attachment, $hr_attatchment, $bsc_attachment, $new_schedule;
    public function render()
    {
        return view('livewire.patient.patient-appointment', [
            'appointments' => Appointment::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get(),
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

    public function cancelAppointment($id)
    {
        $data = Appointment::where('id', $id)->first();
        $data->update([
            'status' => 'canceled',
        ]);


        $this->dialog()->success(

            $title = 'Appointment canceled',

            $description = 'Your appointment set to canceled'

        );
    }

    public function reschedule($id)
    {
        $data = Appointment::where('id', $id)->first();
        $this->appointment_id = $id;
        $this->appointment_data = $data;
        $this->reschedule_modal = true;
    }

    public function saveSchedule()
    {
        $data = Appointment::where('id', $this->appointment_id)->first();

        $data->update([
            'appointment_date' => $this->new_schedule,
            'reason' => $this->reason,
            'is_rescheduled' => true,
        ]);

        Notif::create([
            'user_id' => $data->user->id,
            'patient_appointment_id' => $data->id,
            'doctor_id' => $data->doctor_id,
            'description' => 'Your booking for Dr. ' . $data->doctor->user->name . ' has been rescheduled to. ' . \Carbon\Carbon::parse($this->new_schedule)->format('F d, Y') . '.',

        ]);
        $this->dialog()->success(

            $title = 'Appointment Rescheduled',

            $description = 'Your appointment has beeb scheduled'

        );
        $this->reschedule_modal = false;


    }
}
