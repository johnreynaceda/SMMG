<div>
    <header class="px-10 text-xl font-bold text-gray-600">MY APPOINTMENTS</header>
    <div class="py-5 px-10">
        {{-- <div class="flex">
            <x-native-select wire:model="model">
                <option>Select an Option</option>
                <option>Upcoming</option>
                <option>Past</option>
            </x-native-select>
        </div> --}}
        <div class="flex flex-col space-y-2 mt-3">
            @forelse ($appointments as $appointment)
                <div class="bg-white shadow flex justify-between items-center p-5 px-10 rounded-lg">
                    <div class="flex space-x-3 items-center">
                        <div class="h-32 w-32 rounded-full bg-red-500 overflow-hidden">
                            @if ($appointment->doctor->gender == 'Male')
                                <img src="{{ asset('images/male-doctor.jpg') }}" class="object-cover w-full h-full"
                                    alt="">
                            @else
                                <img src="{{ asset('images/female-doctor.jpg') }}" class="object-cover w-ful h-ful "
                                    alt="">
                            @endif
                        </div>
                        <div>
                            <div class="flex space-x-3 items-center">
                                <h1 class="text-2xl font-bold text-gray-900 uppercase">
                                    {{ $appointment->doctor->user->name }}</h1>
                                @switch($appointment->status)
                                    @case('pending')
                                        <x-badge rounded label="Pending" warning outleine sm />
                                    @break

                                    @case('accepted')
                                        <x-badge rounded label="Accepted" positive outline sm />
                                    @break

                                    @case('declined')
                                        <x-badge rounded label="Declined" negative outline sm />
                                    @break

                                    @case('canceled')
                                        <x-badge rounded label="Cancelled" negative outline sm />
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <h1 class="text-lg text-gray-600">
                                @foreach ($appointment->doctor->doctor_specializations as $value)
                                    {{ $value->specialization->name }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </h1>
                            <div class="flex space-x-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="h-4 w-4 fill-gray-500">
                                    <path
                                        d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM11 13V17H6V13H11ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z">
                                    </path>
                                </svg>
                                <h1 class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if ($appointment->checkup != null)
                            <x-button label="View Details" wire:click="openForm({{ $appointment->id }})"
                                spinner="openForm({{ $appointment->id }})" rounded negative class="px-6 font-bold" />
                        @elseif ($appointment->status == 'accepted')
                            <x-button label="Reschedule" dark icon="calendar"
                                wire:click="reschedule({{ $appointment->id }})" />
                        @elseif($appointment->status == 'pending')
                            <x-button label="Reschedule" dark icon="calendar"
                                wire:click="reschedule({{ $appointment->id }})" />
                            <x-button label="Cancel" negative icon="x"
                                wire:click="cancelAppointment({{ $appointment->id }})" />
                        @else
                        @endif
                    </div>
                </div>
                @empty
                    <div>
                        <span class="text-md">No Appointment Available...</span>
                    </div>
                @endforelse


            </div>
        </div>
        <x-modal.card title="CHECKUP FORM" fullscreen blur wire:model.defer="view_modal">
            <div class="mx-auto max-w-7xl ">
                <div class="border relative rounded-3xl py-5 px-10 shadow-xl">
                    <img src="{{ asset('images/logo.png') }}" class="absolute right-0 bottom-0 opacity-10 h-20"
                        alt="">
                    <div class="flex space-x-4 items-center">
                        <img src="{{ asset('images/doctor.png') }}" class="h-40 w-40 bg-red-500 rounded-full"
                            alt="">
                        <div>
                            <h1 class="text-xl font-bold text-green-600"> CHECK-UP FORM </h1>
                            <h1 class=" font-bold uppercase text-gray-600">
                                {{ $appointment_data->patient_appointment->user->name ?? null }}

                            </h1>
                            <h1 class=" text-gray-600">
                                {{ \Carbon\Carbon::parse($appointment_data->appointment_date ?? null)->format('F d, Y h:i A') }}
                            </h1>
                            <p class="text-justify">Condition:
                                {{ $appointment_data->patient_appointment->condition ?? null }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 rounded-3xl border shadow-xl px-10 py-8">
                    <ul class=" space-y-3">
                        <li class="py-2 border-b flex space-x-5 items-end">
                            <div class="w-64">
                                <h1 class="font-bold text-gray-600">Blood Pressure</h1>
                                <p class="text-justify">{{ $appointment_data->blood_pressure ?? null }}</p>
                            </div>
                            @if ($bp_attachment != null)
                                <a href="{{ Storage::url($bp_attachment) }}" target="_blank"
                                    class="text-sm text-green-500 fill-green-500 hover:underline flex space-x-1 items-center">
                                    <span>Click here to open
                                        attachment</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M20 13C18.3221 13 16.7514 13.4592 15.4068 14.2587C16.5908 15.6438 17.5269 17.2471 18.1465 19H20V13ZM16.0037 19C14.0446 14.3021 9.4079 11 4 11V19H16.0037ZM4 9C7.82914 9 11.3232 10.4348 13.9738 12.7961C15.7047 11.6605 17.7752 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V9ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </li>
                        <li class="py-2 border-b flex space-x-5 items-end">
                            <div class="w-64">
                                <h1 class="font-bold text-gray-600">Heart Rate</h1>
                                <p class="text-justify">{{ $appointment_data->heart_rate ?? null }}</p>
                            </div>
                            @if ($hr_attatchment != null)
                                <a href="{{ Storage::url($hr_attatchment) }}" target="_blank"
                                    class="text-sm text-green-500 fill-green-500 hover:underline flex space-x-1 items-center">
                                    <span>Click here to open
                                        attachment</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M20 13C18.3221 13 16.7514 13.4592 15.4068 14.2587C16.5908 15.6438 17.5269 17.2471 18.1465 19H20V13ZM16.0037 19C14.0446 14.3021 9.4079 11 4 11V19H16.0037ZM4 9C7.82914 9 11.3232 10.4348 13.9738 12.7961C15.7047 11.6605 17.7752 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V9ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </li>
                        <li class="py-2 border-b flex space-x-5 items-end">
                            <div class="w-64">
                                <h1 class="font-bold text-gray-600">Blood Sample Collection</h1>
                                <x-badge label="{{ $is_collected == 1 ? 'TRUE' : 'FALSE' }}" dark xs />
                            </div>
                            @if ($bsc_attachment != null)
                                <a href="{{ Storage::url($bsc_attachment) }}" target="_blank"
                                    class="text-sm text-green-500 fill-green-500 hover:underline flex space-x-1 items-center">
                                    <span>Click here to open
                                        attachment</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M20 13C18.3221 13 16.7514 13.4592 15.4068 14.2587C16.5908 15.6438 17.5269 17.2471 18.1465 19H20V13ZM16.0037 19C14.0446 14.3021 9.4079 11 4 11V19H16.0037ZM4 9C7.82914 9 11.3232 10.4348 13.9738 12.7961C15.7047 11.6605 17.7752 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V9ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </li>
                        <li class="py-2 border-b ">
                            <h1 class="font-bold text-gray-600">Prescription</h1>
                            <p class="text-justify">{{ $appointment_data->prescription ?? null }}</p>
                        </li>
                        <li class="py-2 border-b ">
                            <h1 class="font-bold text-gray-600">Other Information</h1>
                            <p class="text-justify">{{ $appointment_data->other_information ?? null }}</p>
                        </li>

                    </ul>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4 m-auto max-w-7xl">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />

                    </div>
                </div>
            </x-slot>
        </x-modal.card>

        <x-modal wire:model.defer="reschedule_modal" align="center">

            <x-card title="Reschedule Appointment">
                <div>
                    <h1>Appointment Date</h1>
                    <h1 class="text-lg font-bold">
                        {{ \Carbon\Carbon::parse($appointment_data->appointment_date ?? '')->format('F d, Y') }}</h1>
                </div>
                <div class="mt-5">
                    <x-datetime-picker label="Appointment Date" without-time wire:model.defer="new_schedule" />
                </div>
                <x-slot name="footer">

                    <div class="flex justify-end gap-x-4">

                        <x-button flat label="Cancel" x-on:click="close" />

                        <x-button dark label="Reschedule" wire:click="saveSchedule" icon="save" />

                    </div>

                </x-slot>

            </x-card>

        </x-modal>
    </div>
