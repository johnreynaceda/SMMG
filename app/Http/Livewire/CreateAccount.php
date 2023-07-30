<?php

namespace App\Http\Livewire;

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
        } else {
            $this->dialog()->error(
                $title = 'Phone Number is required',
                $description = 'Please enter your phone number to continue',
            );
        }

    }

}