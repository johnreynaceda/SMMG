<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;

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
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;

class DoctorAppointment extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return PatientAppointment::query()->where('doctor_id', auth()->user()->doctor->id);

    }

    protected function getTableColumns(): array
    {

        return [

            Tables\Columns\TextColumn::make('user.name')->label('FULLNAME')->searchable(),
            Tables\Columns\TextColumn::make('doctor.user.name')->label('DOCTOR NAME')->searchable(),
            Tables\Columns\TextColumn::make('condition')->label('CONDITION')->searchable(),
            Tables\Columns\TextColumn::make('appointment_date')->date()->label('APPOINTMENT DATE')->searchable(),
            BadgeColumn::make('status')->label('STATUS')
                ->enum([
                    'pending' => 'Pending',
                    'accepted' => 'Accepted',
                    'declined' => 'Declined',
                ])->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'declined'
                    ]),

        ];

    }

    protected function getTableActions(): array
    {

        return [

            Tables\Actions\ActionGroup::make([
                Action::make('reschedule')->color('warning')->icon('heroicon-o-calendar')->visible(function ($record) {
                    return $record->status == 'accepted';
                })->action(
                        function ($record, $data) {
                            $record->update([
                                'appointment_date' => $data['reschedule'],
                            ]);
                            Notification::make()
                                ->title('Reschedule Successfully')
                                ->success()
                                ->send();
                        }
                    )->form([
                            Fieldset::make('RESCHEDULE INFORMATION')
                                ->schema([
                                    DatePicker::make('reschedule')->required()

                                ])
                                ->columns(1),
                        ])->modalWidth('xl'),
                Action::make('accept')->color('success')->icon('heroicon-o-thumb-up')->visible(function ($record) {
                    return $record->status == 'pending';
                })->action(
                        function ($record) {
                            $record->update([
                                'status' => 'accepted',
                            ]);
                            Notification::make()
                                ->title('Updated Successfully')
                                ->success()
                                ->send();
                        }
                    ),
                Action::make('decline')->color('danger')->icon('heroicon-o-thumb-down')->visible(function ($record) {
                    return $record->status == 'pending';
                })->action(
                        function ($record) {
                            $record->update([
                                'status' => 'declined',
                            ]);
                            Notification::make()
                                ->title('Updated Successfully')
                                ->success()
                                ->send();
                        }
                    ),
            ]),
        ];

    }

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