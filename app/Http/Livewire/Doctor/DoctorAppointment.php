<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Filament\Forms\Components\Grid;
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
use App\Models\Notification as Notif;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;


class DoctorAppointment extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    public $created_from, $created_until, $reschedule_modal = false;
    public $reschedule_date, $appointment_id;

    protected function getTableQuery(): Builder
    {

        return PatientAppointment::query()->where('doctor_id', auth()->user()->doctor->id)->orderBy('created_at', 'DESC');

    }
    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }


    protected function getTableColumns(): array
    {

        return [

            Tables\Columns\TextColumn::make('user.name')->label('FULLNAME')->searchable(),
            Tables\Columns\TextColumn::make('doctor.user.name')->label('DOCTOR NAME')->searchable(),
            Tables\Columns\TextColumn::make('condition')->label('CONDITION')->searchable(),
            Tables\Columns\TextColumn::make('user.patient_profile.address')->label('ADDRESS')->searchable(),
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

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }



    protected function getTableActions(): array
    {

        return [

            Tables\Actions\ActionGroup::make([
                Action::make('done')->color('success')->icon('heroicon-o-check')->visible(function ($record) {
                    return $record->status == 'accepted';
                })->action(
                        function ($record, $data) {
                            $record->update([
                                'status' => 'done',
                            ]);
                            Notification::make()
                                ->title('Reschedule Successfully')
                                ->success()
                                ->send();
                        }
                    ),
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
                            Notif::create([
                                'user_id' => $record->user->id,
                                'patient_appointment_id' => $record->id,
                                'doctor_id' => $record->doctor_id,
                                // 'description' => 'Your booking for Dr. ' . $record->doctor->user->name . ' has been rescheduled.'
                                'description' => 'Your booking for Dr. ' . $record->doctor->user->name . ' has been rescheduled to. ' . \Carbon\Carbon::parse($data['reschedule'])->format('F d, Y') . '.',

                            ]);
                        }
                    )->form([
                            Fieldset::make('RESCHEDULE INFORMATION')
                                ->schema([
                                    DatePicker::make('reschedule')->required()

                                ])
                                ->columns(1),
                        ])->modalWidth('xl'),

                Action::make('done')->color('success')->icon('heroicon-o-check')->visible(function ($record) {
                    return $record->status == 'accepted';
                })->action(
                        function ($record, $data) {
                            $record->update([
                                'status' => 'done',
                            ]);
                            Notification::make()
                                ->title('Reschedule Successfully')
                                ->success()
                                ->send();

                            Notif::create([
                                'user_id' => $record->user->id,
                                'patient_appointment_id' => $record->id,
                                'doctor_id' => $record->doctor_id,
                                'description' => 'Your booking for Dr. ' . $record->doctor->user->name . ' has been done.'

                            ]);
                        }
                    ),
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
                            Notif::create([
                                'user_id' => $record->user->id,
                                'patient_appointment_id' => $record->id,
                                'doctor_id' => $record->doctor_id,
                                'description' => 'Your booking for Dr. ' . $record->doctor->user->name . ' has been approved. See you there and be on time! ' . \Carbon\Carbon::parse($record->appointment_date)->format('F d, Y')

                            ]);
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

                            Notif::create([
                                'user_id' => $record->user->id,
                                'patient_appointment_id' => $record->id,
                                'doctor_id' => $record->doctor_id,
                                'description' => 'Dear ' . $record->user->name . ', Your Appointment for Dr.' . $record->doctor->user->name . ' has been declined.' . 'Please try to book again. Thank you for using our service.',

                            ]);
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
            'appointments' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->whereHas('checkup')->get(),
            'reports' => PatientAppointment::where('doctor_id', auth()->user()->doctor->id)->when($this->created_from, function ($record) {
                return $record->whereBetween('appointment_date', [$this->created_from, $this->created_until]);
            })->get()
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

    public function acceptAppointment($id)
    {
        $data = PatientAppointment::where('id', $id)->first();
        $data->update([
            'status' => 'accepted',
        ]);
        Notification::make()
            ->title('Updated Successfully')
            ->success()
            ->send();
        Notif::create([
            'user_id' => $data->user->id,
            'patient_appointment_id' => $data->id,
            'doctor_id' => $data->doctor_id,
            'description' => 'Your booking for Dr. ' . $data->doctor->user->name . ' has been approved. See you there and be on time! ' . \Carbon\Carbon::parse($data->appointment_date)->format('F d, Y')
        ]);

    }

    public function declineAppointment($id)
    {
        $data = PatientAppointment::where('id', $id)->first();
        $data->update([
            'status' => 'declined',
        ]);
        Notification::make()
            ->title('Updated Successfully')
            ->success()
            ->send();

        Notif::create([
            'user_id' => $data->user->id,
            'patient_appointment_id' => $data->id,
            'doctor_id' => $data->doctor_id,
            'description' => 'Dear ' . $data->user->name . ', Your Appointment for Dr.' . $data->doctor->user->name . ' has been declined.' . 'Please try to book again. Thank you for using our service.',

        ]);
    }

    public function doneAppointment($id)
    {
        $data = PatientAppointment::where('id', $id)->first();
        $data->update([
            'status' => 'done',
        ]);
        Notification::make()
            ->title('Reschedule Successfully')
            ->success()
            ->send();

        Notif::create([
            'user_id' => $data->user->id,
            'patient_appointment_id' => $data->id,
            'doctor_id' => $data->doctor_id,
            'description' => 'Your booking for Dr. ' . $data->doctor->user->name . ' has been done.'

        ]);
    }


    public function rescheduleAppointment($id)
    {
        $this->appointment_id = $id;
        $this->reschedule_modal = true;
    }

    public function submitReschedule()
    {

        $data = PatientAppointment::where('id', $this->appointment_id)->first();


        $data->update([
            'appointment_date' => $this->reschedule_date,
        ]);
        Notification::make()
            ->title('Reschedule Successfully')
            ->success()
            ->send();
        Notif::create([
            'user_id' => $data->user->id,
            'patient_appointment_id' => $data->id,
            'doctor_id' => $data->doctor_id,
            // 'description' => 'Your booking for Dr. ' . $record->doctor->user->name . ' has been rescheduled.'
            'description' => 'Your booking for Dr. ' . $data->doctor->user->name . ' has been rescheduled to. ' . \Carbon\Carbon::parse($this->reschedule_date)->format('F d, Y') . '.',

        ]);
        $this->reschedule_modal = false;

        $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
        $sender = 'SEMAPHORE';
        $ch = curl_init();
        $parameters = [
            'apikey' => $api_key,
            'number' => $data->user->phone_number,
            'message' => 'Your booking for Dr. ' . $data->doctor->user->name . ' has been rescheduled to. ' . \Carbon\Carbon::parse($this->reschedule_date)->format('F d, Y') . '.',
            'sendername' => $sender,
        ];
        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;


    }
}


