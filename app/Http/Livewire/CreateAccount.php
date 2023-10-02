<?php

namespace App\Http\Livewire;

use App\Models\SmsOtp;
use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateAccount extends Component
{
    public $name, $email, $password, $phone_number, $confirm_password;
    public $one, $two, $three, $four;
    public $modal_open = false;
    use Actions;
    public function render()
    {
        return view('livewire.create-account');
    }

    public function verifyNumber()
    {

        if ($this->phone_number != null) {
            $this->validate([
                'phone_number' => 'required|numeric|digits:11|unique:users,phone_number',
            ]);
            $this->modal_open = true;
            $verify = SmsOtp::where('phone_number', $this->contact)->first();
            if ($verify) {
                $random = rand(1000, 9999);
                $verify->update([
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
            } else {
                $random = rand(1000, 9999);
                SmsOtp::create([
                    'phone_number' => $this->contact,
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
        $verify = SmsOtp::where('phone_number', $this->phone_number)->where('otp', $otp)->first();
        if ($verify) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'phone_number' => $this->phone_number,
            ]);
            auth()->loginUsingId($user->id);
            $this->modal_open = false;
            $this->dialog()->success(
                $title = 'Account Verified',
                $description = 'Your account has been verified successfully',

            );
            sleep(10);
            return redirect()->route('dashboard');
        } else {
            $this->reset(['one', 'two', 'three', 'four']);
            $this->dialog()->error(
                $title = 'Invalid OTP',
                $description = 'Please enter the correct OTP sent to your phone number',
            );
        }
    }

}