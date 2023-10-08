<div>
    <div class="flex space-x-10 items-appointment w-full">
        <div>
            <div class="div border rounded-lg relative p-5 overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" class="absolute w-full bg-cover bottom-0 opacity-5"
                    alt="">

                @if ($doctor_data->gender == 'Male')
                    <img src="{{ asset('images/male-doctor.jpg') }}"
                        class="h-40 w-72 rounded-lg relative  object-cover bg-blue-500" alt="">
                @else
                    <img src="{{ asset('images/female-doctor.jpg') }}"
                        class="h-40 w-72 rounded-lg relative  object-cover bg-blue-500" alt="">
                @endif
                <div class="mt-2">
                    <center>
                        <h1 class="uppercase font-bold text-lg text-gray-700">
                            {{ $doctor_data->firstname . ' ' . $doctor_data->lastname }}
                        </h1>
                        <div class="mt-1">
                            <h1 class="text-gray-700 uppercase ">
                                {{-- <h1 class="text-gray-700 ">{{ $doctor_data->specialization->name }}</h1> --}}
                                @foreach ($doctor_data->doctor_specializations as $item)
                                    {{ $item->specialization->name }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </h1>
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
                    <div class="mt-4 grid grid-cols-3 items-end gap-5">
                        <x-datetime-picker class="h-12" label="Appointment Date" without-time
                            wire:model="appointment_date" :min="now()" :max="now()->endOfMonth()" />

                        <x-native-select label="Specialization" class="h-12" wire:model="specialization_id">
                            <option>Select an Option</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->specialization->id }}">
                                    {{ $specialization->specialization->name }}
                                </option>
                            @endforeach
                        </x-native-select>
                        <div class="text-xl" x-animate>
                            @if ($appointment_date)
                                Remaining Slots: {{ $slots }}
                            @endif
                        </div>
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
