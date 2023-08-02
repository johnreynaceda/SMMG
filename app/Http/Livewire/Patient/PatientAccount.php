<?php

namespace App\Http\Livewire\Patient;

use App\Models\User;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

class PatientAccount extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $name, $email, $phone_number, $password;
    public function render()
    {
        return view('livewire.patient.patient-account');
    }

    protected function getFormSchema(): array
    {
        return [

            Grid::make(2)
                ->schema([
                    TextInput::make('name')->placeholder(auth()->user()->name),
                    TextInput::make('email')->email()->placeholder(auth()->user()->email),
                    TextInput::make('phone_number')->numeric()->placeholder(auth()->user()->phone_number),
                ]),
            Grid::make(2)
                ->schema([
                    TextInput::make('password')->password(),

                ])
        ];
    }

    public function updateProfile()
    {
        $patient = User::where('id', auth()->user()->id)->first();

        $patient->update([
            'name' => $this->name ? $this->name : auth()->user()->name,
            'email' => $this->email ? $this->email : auth()->user()->email,
            'phone_number' => $this->phone_number ? $this->phone_number : auth()->user()->phone_number,
            'password' => $this->password ? bcrypt($this->password) : auth()->user()->password,
        ]);

        return redirect()->route('account');
    }
}