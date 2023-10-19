<?php

namespace App\Http\Livewire\Nurse;

use App\Models\PatientAppointment;
use App\Models\User;
use Livewire\Component;
use App\Models\Post;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Notification as Notif;
use Filament\Notifications\Notification;

class NurseDashboard extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {

        return PatientAppointment::query()->where('status', 'pending');

    }

    protected function getTableColumns(): array
    {

        return [
            Tables\Columns\TextColumn::make('user.name')->label('PATIENT NAME')->searchable(),
            Tables\Columns\TextColumn::make('doctor')->label('DOCTOR NAME')->formatStateUsing(
                function ($record) {
                    return 'DR. ' . strtoupper($record->doctor->firstname . ' ' . $record->doctor->lastname);
                }
            ),
            Tables\Columns\TextColumn::make('appointment_date')->date()->label('APPOINTMENT DATE'),
        ];

    }

    protected function getTableActions(): array
    {

        return [

            Action::make('accept')->button()->color('success')->icon('heroicon-o-thumb-up')->action(
                function ($record) {
                    $appointment = PatientAppointment::where('id', $record->id)->first();
                    Notif::create([
                        'user_id' => $appointment->user->id,
                        'patient_appointment_id' => $appointment->id,
                        'doctor_id' => $appointment->doctor_id,
                        'description' => 'Your booking for Dr. ' . $appointment->doctor->user->name . ' has been approved. See you there and be on time! ' . \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y')

                    ]);
                    $appointment->update([
                        'status' => 'accepted',
                    ]);


                    Notification::make()
                        ->title('Saved successfully')
                        ->success()
                        ->send();

                    $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
                    $sender = 'SEMAPHORE';
                    $ch = curl_init();
                    $parameters = [
                        'apikey' => $api_key,
                        'number' => $appointment->user->phone_number,
                        'message' => 'Dear User, Your Appointment for Dr. ' . $appointment->doctor->user->name . ' has been approved.' . 'See you there and be on time! ' . \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') . ' Thank you for using our service.',
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
            ),
            Action::make('decline')->button()->color('danger')->icon('heroicon-o-thumb-down')->action(
                function ($record) {
                    $patient = PatientAppointment::where('id', $record->id)->first();
                    $patient->update([
                        'status' => 'declined',
                    ]);
                    Notification::make()
                        ->title('Declined successfully')
                        ->success()
                        ->send();
                    $this->view_modal = false;

                    $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
                    $sender = 'SEMAPHORE';
                    $ch = curl_init();
                    $parameters = [
                        'apikey' => $api_key,
                        'number' => $patient->user->phone_number,
                        'message' => 'Dear User, Your Appointment for Dr. ' . $patient->doctor->user->name . ' has been declined.' . 'Please try to book again. Thank you for using our service.',
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
            ),
        ];

    }

    public function render()
    {
        return view('livewire.nurse.nurse-dashboard', [
            'patients' => User::where('account_type', 'patient')->whereHas('patientAppointments', function ($record) {
                $record->where('status', 'accepted');
            })->get(),
            'visits' => User::where('account_type', 'patient')->whereDate('created_at', now())->count(),
            'new' => PatientAppointment::whereDate('created_at', '<=', now())->whereDate('created_at', '>=', now()->subDays(5))->count(),
            'old' => PatientAppointment::whereDate('created_at', '<=', now()->subDays(5))->count(),
        ]);
    }
}