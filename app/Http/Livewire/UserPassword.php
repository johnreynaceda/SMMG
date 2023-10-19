<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserPassword extends Component
{
    public $new_password, $confirm_password;
    public function render()
    {
        return view('livewire.user-password');
    }

    public function save()
    {
        $this->validate([
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $data = auth()->user();
        $data->update([
            'password' => bcrypt($this->new_password),
        ]);

        return redirect()->route('patient.dashboard');
    }
}