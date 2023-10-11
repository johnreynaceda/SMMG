<?php

namespace App\Http\Livewire;

use App\Models\Barangay;
use App\Models\City;
use App\Models\PatientProfile;
use App\Models\Province;
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

    public $province_id, $city_id, $barangay_id, $street;




    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('lastname')->required()->extraInputAttributes(['oninput' => 'this.value = this.value.replace(/[^a-zA-Z]/g, "")']),
                    TextInput::make('firstname')->required()->extraInputAttributes(['oninput' => 'this.value = this.value.replace(/[^a-zA-Z]/g, "")']),
                    TextInput::make('middlename')->label('Middlename(Optional)')->extraInputAttributes(['oninput' => 'this.value = this.value.replace(/[^a-zA-Z]/g, "")']),
                    TextInput::make('contact')->numeric()->mask(fn(TextInput\Mask $mask) => $mask->pattern('00000000000'))->required()->unique(),
                    DatePicker::make('birthdate'),
                    TextInput::make('age')->numeric(),
                    Select::make('gender')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                        ]),
                    Select::make('civil_status')
                        ->options([
                            'Single' => 'Single',
                            'Married' => 'Married',
                            'Widowed' => 'Widowed',
                            'Divorced' => 'Divorced',
                        ]),
                    Select::make('province_id')->label('Province')->reactive()->required()
                        ->options(Province::pluck('province_description', 'province_code')),
                    Select::make('city_id')->label('City/Municipality')->reactive()->required()
                        ->options(City::where('province_code', $this->province_id)->pluck('city_municipality_description', 'city_municipality_code')),
                    Select::make('barangay_id')->label('Barangay')->required()
                        ->options(Barangay::where('city_municipality_code', $this->city_id)->pluck('barangay_description', 'barangay_code')),

                ]),


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
                'lastname' => 'required',
                'contact' => 'required|digits:11|unique:users,phone_number',
                'birthdate' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'civil_status' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
                'province_id' => 'required',
                'city_id' => 'required',
                'barangay_id' => 'required',
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

            $province = Province::where('province_code', $this->province_id)->first()->province_description;
            $city = City::where(
                'city_municipality_code',
                $this->city_id
            )->first()->city_municipality_description;
            $barangay = Barangay::where('barangay_code', $this->barangay_id)->first()->barangay_description;

            PatientProfile::create([
                'user_id' => $user->id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'middlename' => $this->middlename ?? 'null',
                'birthdate' => $this->birthdate,
                'age' => $this->age,
                'gender' => $this->gender,
                'civil_status' => $this->civil_status,
                'address' => strtoupper($barangay . ', ' . $city . ', ' . $province),
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