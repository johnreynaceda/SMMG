<?php

namespace App\Http\Livewire\Nurse;

use Livewire\Component;
use Filament\Tables\Actions\Action;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Notifications\Notification;
use DB;

class PatientList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return User::query()->whereHas('patientAppointments');

    }

    public function render()
    {
        return view('livewire.nurse.patient-list', [
            'patients_count' => User::whereHas('patientAppointments')->count(),
        ]);
    }
    protected function getTableColumns(): array
    {

        return [
            Tables\Columns\TextColumn::make('name')->label('NAME')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('EMAIL')->searchable(),
            Tables\Columns\TextColumn::make('phone_number')->label('PHONE NUMBER')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->label('CREATED DATE')->date()->searchable(),

        ];

    }

    protected function getTableActions(): array
    {

        return [

            Action::make('edit')->label('View Result')->icon('heroicon-o-eye')->color('warning'),
        ];


    }
}