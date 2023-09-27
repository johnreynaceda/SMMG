<?php

namespace App\Http\Livewire\Patient;

use App\Models\PatientProfile;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class MyProfile extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $firstname, $lastname, $middlename, $birthdate, $age, $gender, $civil_status, $address;

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('lastname')->required()->placeholder(auth()->user()->patient_profile->lastname ?? ''),
                    TextInput::make('firstname')->required()->placeholder(auth()->user()->patient_profile->firstname ?? ''),
                    TextInput::make('middlename')->required()->placeholder(auth()->user()->patient_profile->middlename ?? ''),
                    DatePicker::make('birthdate')->required()->placeholder(auth()->user()->patient_profile->birthdate ?? ''),
                    TextInput::make('age')->numeric()->required()->placeholder(auth()->user()->patient_profile->age ?? ''),
                    Select::make('gender')->placeholder(auth()->user()->patient_profile->gender ?? '')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                        ]),
                    TextInput::make('civil_status')->required()->placeholder(auth()->user()->patient_profile->civil_status ?? ''),
                ]),
            TextInput::make('address')->required()->placeholder(auth()->user()->patient_profile->address ?? ''),

        ];
    }

    public function submitProfile()
    {
        PatientProfile::create([
            'user_id' => auth()->user()->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'birthdate' => $this->birthdate,
            'age' => $this->age,
            'gender' => $this->gender,
            'address' => $this->address,
            'civil_status' => $this->civil_status,
        ]);

        $this->reset('firstname', 'lastname', 'birthdate', 'age', 'gender', 'address', 'civil_status', 'middlename');

        return redirect()->route('my-profile');
    }

    public function updateProfile()
    {
        $data = PatientProfile::where('user_id', auth()->user()->id)->first();

        $data->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'birthdate' => $this->birthdate,
            'age' => $this->age,
            'gender' => $this->gender,
            'address' => $this->address,
            'civil_status' => $this->civil_status,
        ]);
        $this->reset('firstname', 'lastname', 'birthdate', 'age', 'gender', 'address', 'civil_status', 'middlename');

        return redirect()->route('my-profile');
    }

    public function render()
    {
        return view('livewire.patient.my-profile');
    }
}