<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;

class Reports extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $report;
    public function render()
    {
        return view('livewire.admin.reports', [
            'reports' => $this->generatedReport(),
        ]);
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
        if ($this->report == 1) {
            return \App\Models\User::where('account_type', 'patient')->get();
        } elseif ($this->report == 2) {
            return \App\Models\User::where('account_type', 'doctor')->get();
        } elseif ($this->report == 3) {
            return \App\Models\User::where('account_type', 'nurse')->get();
        } elseif ($this->report == 4) {
            return \App\Models\PatientAppointment::all();
        }
    }

}