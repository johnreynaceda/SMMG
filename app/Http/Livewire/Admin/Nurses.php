<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Filament\Tables\Actions\Action;
use App\Models\Nurse;
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
use Filament\Forms\Components\Select;

class Nurses extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return Nurse::query();

    }

    protected function getTableHeaderActions()
    {

        return [

            Action::make('new_nurse')->label('Add New Nurses')->button()->icon('heroicon-o-plus-circle')->action(function ($record, $data) {

                DB::beginTransaction();
                $user = User::create([
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => bcrypt($data['password']),
                    'account_type' => 'nurse',
                ]);

                Nurse::create([
                    'user_id' => $user->id,
                    'firstname' => $data['firstname'],
                    'middlename' => $data['middlename'] == null ? 'null' : $data['middlename'],
                    'lastname' => $data['lastname'],
                    'gender' => $data['gender'],
                    // 'image_path' => $data['attachment'][0]->store('doctor_attachments', 'public'),
    
                ]);
                DB::commit();
                Notification::make()
                    ->title('Added Successfully')
                    ->success()
                    ->send();
            })->form([
                        Fieldset::make('NURSE INFORMATION')
                            ->schema([
                                TextInput::make('firstname')->label('First Name')->required(),
                                TextInput::make('middlename')->label('Middle Name (Optional)'),
                                TextInput::make('lastname')->label('Last Name')->required(),
                                TextInput::make('phone_number')->label('Phone Number')->numeric()->required(),
                                Select::make('gender')->required()
                                    ->options([
                                        'Male' => 'Male',
                                        'Female' => 'Female',
                                    ]),
                                // FileUpload::make('attachment')->label('Attachment')->multiple()->required(),
                            ])
                            ->columns(3),
                        Fieldset::make('ACCOUNT INFORMATION')
                            ->schema([
                                TextInput::make('email')->label('Email')->email()->required(),
                                TextInput::make('password')->label('Password')->password()->required(),

                            ])
                            ->columns(2)

                    ])

        ];

    }

    protected function getTableColumns(): array
    {

        return [

            ViewColumn::make('name')->label('FULLNAME')->view('admin.nurses-filament')->searchable(['firstname', 'middlename', 'lastname']),
            Tables\Columns\TextColumn::make('user.email')->label('EMAIL')->searchable(),
            Tables\Columns\TextColumn::make('user.phone_number')->label('PHONE NUMBER')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->label('CREATED DATE')->date()->searchable(),
        ];

    }

    protected function getTableActions(): array
    {

        return [

            Action::make('edit')->label('Edit')->icon('heroicon-o-pencil-alt')->color('success')->action(
                function ($record, $data) {
                    $record->update([
                        'firstname' => $data['firstname'],
                        'middlename' => $data['middlename'] == 'null' ? 'null' : $data['middlename'],
                        'lastname' => $data['lastname'],
                        // 'specialization' => $data['specialization'],
                        // 'image_path' => $data['attachment'][0]->store('doctor_attachments', 'public'),
                    ]);

                    $record->user->update([
                        'name' => $data['firstname'] . ' ' . $data['lastname'],
                        'email' => $data['email'],
                        'phone_number' => $data['phone_number'],
                        'password' => bcrypt($data['password']),
                        'account_type' => 'nurse',
                    ]);
                    Notification::make()
                        ->title('Saved successfully')
                        ->success()
                        ->send();
                }
            )->form(
                    function ($record) {
                        return [
                            Fieldset::make('NURSE INFORMATION')
                                ->schema([
                                    TextInput::make('firstname')->label('First Name')->required()->default($record->firstname),
                                    TextInput::make('middlename')->label('Middle Name (Optional)')->default($record->middlename),
                                    TextInput::make('lastname')->label('Last Name')->required()->default($record->lastname),
                                    TextInput::make('phone_number')->label('Phone Number')->numeric()->required()->default($record->user->phone_number),
                                    // FileUpload::make('attachment')->label('Attachment')->multiple()->required(),
                                ])
                                ->columns(3),
                            Fieldset::make('ACCOUNT INFORMATION')
                                ->schema([
                                    TextInput::make('email')->label('Email')->email()->required()->default($record->user->email),
                                    TextInput::make('password')->label('Password')->password()->required(),

                                ])
                                ->columns(2)
                        ];
                    }
                )->modalHeading('Update Nurse'),
            Tables\Actions\DeleteAction::make(),

        ];


    }


    public function render()
    {
        return view('livewire.admin.nurses', [
            'nurse_count' => Nurse::count(),
        ]);
    }
}
