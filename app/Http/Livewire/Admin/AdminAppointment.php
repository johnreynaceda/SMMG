<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\PatientAppointment;
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
use Filament\Tables\Columns\BadgeColumn;
use DB;
use Filament\Forms\Components\Select;

class AdminAppointment extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return PatientAppointment::query()->orderBy('created_at', 'desc');

    }

    protected function getTableColumns(): array
    {

        return [

            Tables\Columns\TextColumn::make('user.name')->label('NAME')->searchable(),
            Tables\Columns\TextColumn::make('doctor.user.name')->label('DOCTOR NAME')->searchable(),
            Tables\Columns\TextColumn::make('doctor.specialization.name')->label('SPECIALIZATION')->searchable(),
            Tables\Columns\TextColumn::make('appointment_date')->date()->label('APPOINTMENT DATE')->searchable(),
            BadgeColumn::make('status')
                ->enum([
                    'pending' => 'Pending',
                    'accepted' => 'Accepted',
                    'declined' => 'Declined',
                ])->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'declined',
                    ])
        ];

    }
    public function render()
    {
        return view('livewire.admin.admin-appointment', [
            'appointment_count' => PatientAppointment::count(),
        ]);
    }
}