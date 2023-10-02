<div>
    <section>
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-white p-5 rounded-lg flex space-x-4 items-start border-red-300 border">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10 fill-red-500">
                    <path
                        d="M17 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9V3H15V1H17V3ZM4 9V19H20V9H4ZM6 13H11V17H6V13Z">
                    </path>
                </svg>
                <div>
                    <h1 class="text-2xl font-bold">
                        @php
                            $count = \App\Models\PatientAppointment::where('doctor_id', auth()->user()->doctor->id)
                                ->where('status', 'accepted')
                                ->count();
                        @endphp
                        {{ $count }}
                    </h1>
                    <h1 class="text-sm leading-3">Appointment(s)</h1>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg flex space-x-4 items-start border-green-300 border">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10 fill-green-500">
                    <path
                        d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM8 7H16V9H8V7ZM8 11H16V13H8V11ZM8 15H13V17H8V15Z">
                    </path>
                </svg>
                <div>
                    <h1 class="text-2xl font-bold">
                        @php
                            $count = \App\Models\PatientAppointment::where('doctor_id', auth()->user()->doctor->id)
                                ->where('status', 'accepted')
                                ->count();
                        @endphp
                        {{ $count }}
                    </h1>
                    <h1 class="text-sm leading-3"> Patient(s)</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-10 grid grid-cols-1 gap-5">
        <div class="bg-white rounded-lg p-5">
            <header class="flex justify-between items-center">
                <h1 class="text-[#617E5B] uppercase font-semibold">Appointment Request</h1>
                <a href="" class="text-sm text-[#617E5B]/50 hover:text-[#617E5B]">See All</a>
            </header>
            <div class="mt-4 flex flex-col space-y-4" x-animate>
                @forelse ($appointments as $appointment)
                    <div class="flex justify-between item-center px-3 py-2 border-b">
                        <div class="flex space-x-2 items-center">
                            <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-blue-500 rounded-full"
                                alt="">
                            <div>
                                <h1 class="uppercase font-bold text-gray-700">{{ $appointment->user->name }}</h1>
                                <button wire:click="openRequest({{ $appointment->id }})"
                                    class="flex space-x-0.5 items-center hover:underline text-yellow-600 fill-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3 w-3">
                                        <path
                                            d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z">
                                        </path>
                                    </svg>
                                    <span class="text-xs">View Appointment</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex space-x-2 items-center">
                            @if ($appointment->status == 'accepted')
                                <x-badge rounded positive>Accepted</x-badge>
                            @elseif ($appointment->status == 'declined')
                                <x-badge rounded negative>Declined</x-badge>
                            @else
                                <x-button label="Decline" rounded negative outline xs right-icon="x-circle"
                                    wire:click="decline({{ $appointment->id }})"
                                    spinner="decline({{ $appointment->id }})" class="font-semibold" />
                                <x-button label="Accept" wire:click="accept({{ $appointment->id }})"
                                    spinner="accept({{ $appointment->id }})" loading-delay="short" rounded positive xs
                                    right-icon="check-circle" class="font-semibold" />
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="mt-5">
                        <h1 class="text-gray-500 text-center">No Appointment Request</h1>
                    </div>
                @endforelse


            </div>
        </div>
        {{-- <div class="bg-white rounded-lg p-5">
            <header class="flex justify-between items-center">
                <h1 class="text-[#617E5B] uppercase font-semibold">Today's Appointment</h1>
                <a href="" class="text-sm text-[#617E5B]/50 hover:text-[#617E5B]">See All</a>
            </header>

            <div class="mt-4 flex flex-col space-y-4" x-animate>
                @forelse ($todays as $appointment)
                    <div class="flex justify-between items-center px-3 py-2 border-b">
                        <div class="flex space-x-2 items-center">
                            <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-red-500 rounded-full"
                                alt="">
                            <h1 class="uppercase font-bold text-gray-700">{{ $appointment->user->name }}</h1>
                        </div>
                        <span
                            class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</span>
                    </div>
                @empty
                    <div class="mt-5">
                        <h1 class="text-gray-500 text-center">No Appointment Today</h1>
                    </div>
                @endforelse
            </div>
        </div> --}}
    </div>
    <x-modal wire:model.defer="view_modal" align="center">
        <x-card title="Appointment Information">
            <div>
                <div class="flex flex-col space-y-3">
                    <div>
                        <span>Patient Name</span>
                        <h1 class="text-gray-700 font-bold">{{ $appointment_data->user->name ?? null }}</h1>
                    </div>
                    <div>
                        <span>Condition</span>
                        <p class="text-gray-700 font-bold">{{ $appointment_data->condition ?? null }}</p>
                    </div>
                    <div>
                        <span>Appointment Date</span>
                        <p class="text-gray-700 font-bold">
                            {{ \Carbon\Carbon::parse($appointment_data->appointment_date ?? null)->format('F d, Y h:i A') }}
                        </p>
                    </div>
                </div>
                <x-slot name="footer">
                    <div class="flex justify-between items-center">
                        <div>
                            <x-button x-on:click="close" label="Cancel" rounded negative flat xs
                                class="font-semibold" />
                        </div>
                        <div>
                            <x-button label="Decline" wire:click="decline({{ $appointment_data->id ?? null }})"
                                spinner="decline({{ $appointment_data->id ?? null }})" rounded negative outline xs
                                right-icon="x-circle" class="font-semibold" />
                            <x-button label="Accept" wire:click="accept({{ $appointment_data->id ?? null }})"
                                spinner="accept({{ $appointment_data->id ?? null }})" loading-delay="short" rounded
                                positive xs right-icon="check-circle" class="font-semibold" />
                        </div>
                    </div>
                </x-slot>
        </x-card>
    </x-modal>
</div>
