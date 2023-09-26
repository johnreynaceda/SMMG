<?php

namespace App\Http\Livewire\Nurse;

use App\Models\Checkup;
use App\Models\PatientAppointment;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use DB;


class TaskList extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $form_modal = false;
    public $result_data = false;
    public $is_collected;
    public $appointment_id;
    public $appointment_data;
    public $bp_attachment, $bp, $heart, $hr_attachment, $blood_is_collected, $bsc_attachment, $prescription, $other_info;
    public function render()
    {
        return view('livewire.nurse.task-list', [
            'appointments' => PatientAppointment::where('status', 'accepted')->orderBy('created_at', 'DESC')->get()

        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('bp')->label('Blood Pressure')->suffix('mm/hg'),
                    FileUpload::make('bp_attachment')->label('+Add Picture of Reading'),
                ]),
            Grid::make(2)
                ->schema([
                    TextInput::make('heart')->label('Heart Rate')->suffix('bpm'),
                    FileUpload::make('hr_attachment')->label('+Add Picture of Reading'),
                ]),
            Grid::make(2)
                ->schema([
                    Toggle::make('blood_is_collected')->label('Toggle as collected'),
                    FileUpload::make('bsc_attachment')->label('+Add Picture of Reading'),
                ]),
            Grid::make(1)
                ->schema([
                    Textarea::make('prescription')->label('Prescription'),
                    Textarea::make('other_info')->label('Other Information'),

                ]),
        ];
    }

    public function openFormModal($id)
    {
        $this->appointment_id = $id;
        $this->appointment_data = PatientAppointment::where('id', $id)->first();

        $this->form_modal = true;
    }

    public function saveForm()
    {
        DB::beginTransaction();
        Checkup::create([
            'patient_appointment_id' => $this->appointment_id,
            'blood_pressure' => $this->bp ? $this->bp : null,
            'bp_attachment' => $this->bp_attachment ? collect($this->bp_attachment)->first()->store('bloodPressure', 'public') : null,
            'heart_rate' => $this->heart ? $this->heart : null,
            'hr_attachment' => $this->hr_attachment ? collect($this->hr_attachment)->first()->store('heartRate', 'public') : null,
            'blood_is_collected' => $this->blood_is_collected ? $this->blood_is_collected : null,
            'bsc_attachment' => $this->bsc_attachment ? collect($this->bsc_attachment)->first()->store('bloodSample', 'public') : null,
            'prescription' => $this->prescription ? $this->prescription : null,
            'other_information' => $this->other_info ? $this->other_info : null
        ]);
        DB::commit();

        $this->form_modal = false;
    }

    public function printForm($id)
    {

        $this->appointment_data = PatientAppointment::where('id', $id)->first()->checkup;
        $this->is_collected = $this->appointment_data->blood_is_collected;
        $this->bp_attachment = $this->appointment_data->bp_attachment;
        $this->hr_attachment = $this->appointment_data->hr_attachment;
        $this->bsc_attachment = $this->appointment_data->bsc_attachment;
        $this->result_data = true;
    }
}