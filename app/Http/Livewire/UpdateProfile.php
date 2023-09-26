<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UpdateProfile extends Component
{

    public $name, $email, $phone_number;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone_number = auth()->user()->phone_number;
    }
    public function render()
    {
        return view('livewire.update-profile');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        $data = auth()->user();
        $data->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number
        ]);
    }
}