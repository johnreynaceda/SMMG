<?php

namespace App\Http\Livewire;

use App\Models\SmsOtp;
use App\Models\User;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use WireUi\Traits\Actions;

class PatientRegister extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $verification_modal = false;
    use Actions;

    public $firstname, $lastname, $middlename, $birthdate, $age, $gender, $civil_status, $address, $contact, $email, $password, $password_confirmation;
    public $one, $two, $three, $four, $date;


    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('lastname')->required(),
                    TextInput::make('firstname')->required(),
                    TextInput::make('middlename')->required(),
                    TextInput::make('contact')->numeric()->mask(fn(TextInput\Mask $mask) => $mask->pattern('00000000000'))->required()->unique(),
                    DatePicker::make('birthdate'),
                    TextInput::make('age')->numeric(),
                    Select::make('gender')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                        ]),
                    TextInput::make('civil_status')->required(),
                ]),
            TextInput::make('address')->required(),

            Fieldset::make('ACCOUNT INFORMATION')
                ->schema([
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')->password()->required(),
                    TextInput::make('password_confirmation')->password()->required()

                ])
                ->columns(2)

        ];
    }

    public function createAccount()
    {
        sleep(3);
        if ($this->contact) {
            $this->validate([
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname' => 'required',
                'contact' => 'required|digits:11|unique:users,phone_number',
                'birthdate' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'civil_status' => 'required',
                'address' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);
            $this->verification_modal = true;
            $verify = SmsOtp::where('phone_number', $this->contact)->first();
            if ($verify) {
                $random = rand(1000, 9999);
                $verify->update([
                    'otp' => $random,
                ]);
                $this->date = now()->addMinutes(2);
                $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
                $sender = 'SEMAPHORE';
                $ch = curl_init();
                $parameters = [
                    'apikey' => $api_key,
                    'number' => $this->contact,
                    'message' => 'Dear ' . strtoupper($this->firstname) . ', your OTP for account verification is ' . $random . '.' . ' Thank you for using our service.',
                    'sendername' => $sender,
                ];
                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                return $output;


            } else {
                $random = rand(1000, 9999);
                SmsOtp::create([
                    'phone_number' => $this->contact,
                    'otp' => $random,
                ]);
                $this->date = now()->addMinutes(2);
                $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
                $sender = 'SEMAPHORE';
                $ch = curl_init();
                $parameters = [
                    'apikey' => $api_key,
                    'number' => $this->contact,
                    'message' => 'Dear ' . strtoupper($this->firstname) . ', your OTP for account verification is ' . $random . '.' . ' Thank you for using our service.',
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
        } else {
            $this->dialog()->error(
                $title = 'Phone Number is required',
                $description = 'Please enter your phone number to continue',
            );
        }



    }

    public function verifyAccount()
    {
        $this->validate([
            'one' => 'required|numeric|digits:1',
            'two' => 'required|numeric|digits:1',
            'three' => 'required|numeric|digits:1',
            'four' => 'required|numeric|digits:1',
        ]);
        $otp = $this->one . $this->two . $this->three . $this->four;
        $verify = SmsOtp::where('phone_number', $this->contact)->where('otp', $otp)->first();
        if ($verify) {
            $user = User::create([
                'name' => $this->firstname . ' ' . $this->lastname,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'phone_number' => $this->contact,
            ]);
            auth()->loginUsingId($user->id);
            $this->modal_open = false;
            $this->dialog()->success(
                $title = 'Account Verified',
                $description = 'Your account has been verified successfully',

            );
            sleep(5);
            return redirect()->route('dashboard');
        } else {
            $this->reset(['one', 'two', 'three', 'four']);
            $this->dialog()->error(
                $title = 'Invalid OTP',
                $description = 'Please enter the correct OTP sent to your phone number',
            );
        }
    }

    public function resendCode()
    {
        $data = SmsOtp::where('phone_number', '=', $this->contact)->first();
        $random = rand(1000, 9999);
        $data->update([
            'otp' => $random,
        ]);

        $api_key = '1aaad08e0678a1c60ce55ad2000be5bd';
        $sender = 'SEMAPHORE';
        $ch = curl_init();
        $parameters = [
            'apikey' => $api_key,
            'number' => $this->contact,
            'message' => 'Dear ' . strtoupper($this->firstname) . ', your OTP for account verification is ' . $random . '.' . ' Thank you for using our service.',
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

    public function render()
    {
        return view('livewire.patient-register');
    }
}