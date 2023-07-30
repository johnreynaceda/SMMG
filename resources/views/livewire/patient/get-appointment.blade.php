<div>
    <div class="flex space-x-10 items-appointment w-full">
        <div>
            <div class="div border rounded-lg relative p-5 overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" class="absolute w-full bg-cover bottom-0 opacity-5"
                    alt="">
                {{-- <img src="" > --}}
                @if ($doctor_data->image_path)
                    <img src="{{ asset('storage/' . $item->image) }}"
                        class="h-40 w-72 rounded-lg relative  object-cover bg-blue-500" alt="" alt="">
                @else
                    <img src="{{ asset('images/doctor.png') }}"
                        class="h-40 w-72 rounded-lg object-cover relative bg-blue-500" alt="" alt="">
                @endif
                <div class="mt-2">
                    <center>
                        <h1 class="uppercase font-bold text-lg text-gray-700">
                            {{ $doctor_data->firstname . ' ' . $doctor_data->lastname }}
                        </h1>
                        <div class="mt-1">
                            <h1 class="text-gray-700 ">{{ $doctor_data->specialization }}</h1>
                        </div>
                        <div class="mt-1">
                            <h1 class="text-gray-700 ">({{ $doctor_data->schedule }})</h1>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <div class="flex-1 w-full">
            <div class="border p-5 rounded-lg">
                <h1 class="font-bold text-xl text-gray-700 ">APPOINTMENT DETAILS</h1>
                <div class="mt-5">
                    <div>
                        {{ $this->form }}
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-5">
                        <x-datetime-picker label="Appointment Date" without-time wire:model.defer="appointment_date" />
                        <x-time-picker label="AM/PM" wire:model.defer="appointment_time" />
                    </div>
                    <div class="mt-3 flex justify-end items-center">
                        <x-button label="Submit Appointment" wire:click="submitApplication" spinner="submitApplication"
                            class="font-bold" right-icon="arrow-right" positive rounded />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
