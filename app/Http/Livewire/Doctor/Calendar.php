<?php

namespace App\Http\Livewire\Doctor;

use App\Models\PatientAppointment;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];
    public $view_modal = false;

    public function mount()
    {
        $this->events = $this->getFormattedEvents();
    }

    public function getFormattedEvents()
    {
        $events = PatientAppointment::where('doctor_id', auth()->user()->doctor->id)
            ->where('status', 'accepted')
            ->get();

        $formattedEvents = [];
        foreach ($events as $event) {
            $startDateTime = date('Y-m-d H:i', strtotime($event->appointment_date));
            $endDateTime = date('Y-m-d H:i', strtotime($event->appointment_date));
            $formattedEvents[] = [
                'title' =>
                $event->user->name,
                'start' => $startDateTime,
                'end' => $endDateTime,
                'name' => $event->user->name,
                'description' => $event->condition,
                'other' =>
                \Carbon\Carbon::parse($startDateTime)->format('g:i A'),
                'event_id' => $event->id,
            ];
        }
        return $formattedEvents;
    }


    public function render()
    {
        return view('livewire.doctor.calendar');
    }
}