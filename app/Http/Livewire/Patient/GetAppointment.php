<?php

namespace App\Http\Livewire\Patient;

use App\Models\Doctor;
use App\Models\PatientAppointment;
use App\Models\Slot;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use WireUi\Traits\Actions;

class GetAppointment extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;
    public $doctor_id;

    public $condition, $appointment_date, $appointment_time;

    public function mount()
    {
        $this->doctor_id = request()->route()->parameter('id');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('condition')->label('')->placeholder('Describe your condition'),
            // DatePicker::make('date_of_birth')->format('d/m/Y')
        ];
    }

    public function render()
    {

        return view('livewire.patient.get-appointment', [
            'doctor_data' => Doctor::where('id', $this->doctor_id)->first(),
        ]);
    }

    public function submitApplication()
    {
        $this->validate([
            'condition' => 'required',
            'appointment_date' => 'required',
        ]);

        $slot = Slot::first()->default_slot;
        $date = PatientAppointment::whereDate('appointment_date', $this->appointment_date)->where('doctor_id', $this->doctor_id)->count();

        if ($date < $slot) {
            PatientAppointment::create([
                'user_id' => auth()->user()->id,
                'doctor_id' => $this->doctor_id,
                'condition' => $this->condition,
                'appointment_date' => \Carbon\Carbon::parse(
                    $this->appointment_date
                )->format('Y-m-d'),
            ]);
            Notification::make()
                ->title('Submit successfully')
                ->success()
                ->send();

            return redirect()->route('submit-appointment');
        } else {
            $this->dialog()->error(
                $title = 'Slot is Full',
                $description = 'Your selected appointment id already full. Please choose another appointment date.'

            );
        }



    }
}