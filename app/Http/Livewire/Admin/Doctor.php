<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Filament\Tables\Actions\Action;
use Livewire\Component;
use App\Models\Doctor as doctorModel;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use Filament\Tables\Columns\Layout\Stack;
use DB;

class Doctor extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return doctorModel::query();

    }

    protected function getTableHeaderActions()
    {

        return [

            Action::make('new_doctor')->label('Add New Doctor')->button()->icon('heroicon-o-plus-circle')->action(function ($record, $data) {
                // dd($data['attachment']);
                DB::beginTransaction();
                $user = User::create([
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => bcrypt($data['password']),
                ]);

                doctorModel::create([
                    'user_id' => $user->id,
                    'firstname' => $data['firstname'],
                    'middlename' => $data['middlename'],
                    'lastname' => $data['lastname'],
                    'specialization' => $data['specialization'],
                    // 'image_path' => $data['attachment'][0]->store('doctor_attachments', 'public'),
    
                ]);


                DB::commit();
            })->form([
                        Fieldset::make('DOCTOR INFORMATION')
                            ->schema([
                                TextInput::make('firstname')->label('First Name')->required(),
                                TextInput::make('middlename')->label('Middle Name')->required(),
                                TextInput::make('lastname')->label('Last Name')->required(),
                                TextInput::make('phone_number')->label('Phone Number')->numeric()->required(),
                                TextInput::make('specialization')->label('Specialization')->required(),
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

            ViewColumn::make('name')->label('FULLNAME')->view('admin.doctor-filament')->searchable(['firstname', 'middlename', 'lastname', 'specialization']),
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
                        'middlename' => $data['middlename'],
                        'lastname' => $data['lastname'],
                        'specialization' => $data['specialization'],
                        // 'image_path' => $data['attachment'][0]->store('doctor_attachments', 'public'),
                    ]);

                    $record->user->update([
                        'name' => $data['firstname'] . ' ' . $data['lastname'],
                        'email' => $data['email'],
                        'phone_number' => $data['phone_number'],
                        'password' => bcrypt($data['password']),
                    ]);
                }
            )->form(
                    function ($record) {
                        return [
                            Fieldset::make('DOCTOR INFORMATION')
                                ->schema([
                                    TextInput::make('firstname')->label('First Name')->required()->default($record->firstname),
                                    TextInput::make('middlename')->label('Middle Name')->required()->default($record->middlename),
                                    TextInput::make('lastname')->label('Last Name')->required()->default($record->lastname),
                                    TextInput::make('phone_number')->label('Phone Number')->numeric()->required()->default($record->user->phone_number),
                                    TextInput::make('specialization')->label('Specialization')->required()->default($record->specialization),
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
                )->modalHeading('Update Doctor'),
            Tables\Actions\DeleteAction::make(),

        ];

    }
    public function render()
    {
        return view('livewire.admin.doctor', [
            'doctor_count' => doctorModel::count(),
        ]);
    }
}