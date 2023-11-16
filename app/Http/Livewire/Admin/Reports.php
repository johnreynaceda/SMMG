<?php

namespace App\Http\Livewire\Admin;

use App\Models\PatientAppointment;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;

class Reports extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $report;
    public $active_filter = 3, $month;

    public $years = [];

    public $date_from, $date_to;
    public $selectedYear = '';
    public function render()
    {
        return view('livewire.admin.reports', [
            'reports' => $this->generatedReport(),
        ]);
    }

    public function mount()
    {
        $currentYear = now()->year;
        $years = [];

        // Generate a list of years from the current year to 10 years in the past
        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
            $years[] = $year;
        }

        $this->years = $years;
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('report')->label(' Report')->reactive()
                ->options([
                    '1' => 'List of Patients',
                    '2' => 'List of Doctors',
                    '3' => 'List of Nurses',
                    '4' => 'List of Appointments',
                ])
        ];
    }

    public function generatedReport()
    {
        if ($this->active_filter == 1) {
            return PatientAppointment::whereDate('created_at', now())->get();
        } elseif ($this->active_filter == 2) {
            $last7day = now()->subDays(7);
            return PatientAppointment::whereBetween('created_at', [$last7day, now()])->get();
        } elseif ($this->active_filter == 3) {
            return PatientAppointment::when($this->date_from, function ($record) {
                return $record->whereBetween('appointment_date', [$this->date_from, $this->date_to]);
            })->get();
        } elseif ($this->active_filter == 4) {
            return PatientAppointment::when($this->selectedYear, function ($record) {
                return $record->whereYear('created_at', $this->selectedYear);
            })->get();
        } else {
            return PatientAppointment::all();
        }
    }

}
