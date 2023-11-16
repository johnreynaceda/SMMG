<?php

namespace App\Http\Livewire\Patient;

use App\Models\Notification;
use Livewire\Component;

class PatientNotification extends Component
{

    public function mount()
    {
        $data = Notification::where('user_id', auth()->user()->id)->where('read_at', null)->get();
        foreach ($data as $key => $value) {
            $value->update([
                'read_at' => now(),
            ]);
        }
    }
    public function render()
    {

        return view('livewire.patient.patient-notification', [
            'notifications' => Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get(),
        ]);
    }

}
