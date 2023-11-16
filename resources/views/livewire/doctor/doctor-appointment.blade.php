{{-- <div x-data>
    <div class="grid grid-cols-3 gap-4">
        @forelse ($appointments as $item)
            <div class="bg-white p-5 relative rounded-xl shadow-xl">
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-red-500 rounded-full" alt="">
                    <div class="flex-1">
                        <div class="flex justify-between  space-x-3">
                            <h1 class="uppercase font-bold text-gray-700">{{ $item->user->name }}</h1>
                            @switch($item->status)
                                @case('pending')
                                    <x-badge label="Pending" warning outline xs />
                                @break

                                @case('accepted')
                                    <x-badge label="Accepted" positive outline xs />
                                @break

                                @case('declined')
                                    <x-badge label="Decline" negative outline xs />
                                @break

                                @default
                            @endswitch
                        </div>
                        <h1 class="text-sm leading-3 text-gray-500">
                            {{ \Carbon\Carbon::parse($item->appointment_date)->format('F d, Y h:i A ') }}</h1>
                    </div>
                </div>
                <div class="mt-2 mb-14">
                    <h1 class="text-sm leading-3 text-gray-500">Condition:</h1>
                    <p class="text-sm leading-4 mt-1 text-justify text-gray-700">{{ $item->condition }}</p>
                </div>
                <div class="absolute bottom-2 pt-2 left-5 right-5 border-t mt-5">
                    <div class="flex justify-end space-x-2 items-center">
                        @if ($item->has('checkup'))
                            <x-button label="View Check-Up Form" wire:click="openForm({{ $item->id }})"
                                spinner="openForm({{ $item->id }})" icon="eye" xs rounded warning />
                        @else
                            @if ($item->status == 'pending')
                                <x-button label="Declined" icon="x-circle" xs rounded outline negative />
                                <x-button label="Accepted" icon="check-circle" xs rounded positive />
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="mt-5 col-span-3">
                    <h1 class="text-gray-600 font-medium text-xl text-center">No Appointment Check-Up Result...</h1>
                </div>
            @endforelse
        </div>
        <x-modal.card title="CHECKUP FORM" fullscreen blur wire:model.defer="view_modal">
            <div class="mx-auto max-w-7xl " x-ref="printContainer">
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
                        <x-button dark label="Print Form" right-icon="printer"
                            @click="printOut($refs.printContainer.outerHTML);" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
    </div> --}}

<div x-data>
    <div class="flex justify-between items-end">
        <div class="flex space-x-3 items-center">
            <x-datetime-picker label="Date From" placeholder="{{ now()->format('F m, Y') }}" without-time
                wire:model="created_from" />
            <x-datetime-picker label="Date To" placeholder="{{ now()->format('F m, Y') }}" without-time
                wire:model="created_until" />
        </div>
        <div>
            <x-button label="PRINT" class="font-bold" @click="printOut($refs.printContainer.outerHTML);" dark
                icon="printer" />
        </div>

    </div>
    <div class="mt-5">
        <div x-ref="printContainer" class="bg-white p-5 rounded-xl">
            <div class="flex space-x-3 items-center">
                <div>
                    <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-700">MMG - BULAN</h1>
                    <h1 class="text-md  leading-3 font-bold uppercase text-gray-500">Appointments List</h1>
                </div>
            </div>
            <div class="mt-10">
                <table id="example" class="table-auto" style="width:100%">
                    <thead class="font-normal">
                        <tr>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">PATIENT NAME
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">DOCTOR NAME
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">CONDITION
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">ADDRESS</th>

                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">DATE OF
                                APPOINTMENT
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                STATUS
                            </th>
                            <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">

                            </th>


                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($reports as $report)
                            <tr>
                                <td class="border-2 uppercase text-gray-700  px-3 py-1">
                                    {{ $report->user->name }}
                                </td>
                                <td class="border-2 uppercase text-gray-700  px-3 py-1">
                                    {{ $report->doctor->user->name }}
                                </td>
                                <td class="border-2 uppercase text-gray-700  px-3 py-1">
                                    {{ $report->condition }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    {{ $report->user->patient_profile->address }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    {{ \Carbon\Carbon::parse($report->appointment_date)->format('F d, Y') }}
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    @switch($report->status)
                                        @case('pending')
                                            <x-badge label="Pending" warning />
                                        @break

                                        @case('accepted')
                                            <x-badge label="Accepted" positive />
                                        @break

                                        @case('declined')
                                            <x-badge label="Declined" negative />
                                        @break

                                        @case('done')
                                            <x-badge label="Done" outline positive />
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="border-2  text-gray-700  px-3 py-1">
                                    @if ($report->status != 'done')
                                        <x-dropdown>

                                            <x-slot name="trigger">

                                                <x-button xs label="Options" dark />

                                            </x-slot>

                                            @if ($report->status == 'pending')
                                                <x-dropdown.item label="Accept"
                                                    wire:click="acceptAppointment({{ $report->id }})"
                                                    icon="thumb-up" />
                                                <x-dropdown.item label="Decline"
                                                    wire:click="declineAppointment({{ $report->id }})"
                                                    icon="thumb-down" />
                                            @endif
                                            @if ($report->status == 'accepted')
                                                <x-dropdown.item label="Done"
                                                    wire:click="doneAppointment({{ $report->id }})" icon="check" />

                                                <x-dropdown.item label="Reschedule"
                                                    wire:click="rescheduleAppointment({{ $report->id }})"
                                                    icon="clock" />
                                            @endif


                                        </x-dropdown>
                                    @endif
                                </td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border-2 px-2 py-2">
                                        <span class="text-center  ">
                                            No data...
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <x-modal wire:model.defer="reschedule_modal" align="center" max-width="lg">

            <x-card title="RESCHEDULE">

                <div class="p-5">
                    <x-datetime-picker label="Reschedule Date" without-time placeholder="{{ now() }}"
                        wire:model="reschedule_date" />
                </div>



                <x-slot name="footer">

                    <div class="flex justify-end gap-x-4">

                        <x-button flat label="Cancel" x-on:click="close" />

                        <x-button label="Submit" wire:click="submitReschedule" spinner="submitReschedule" dark
                            class="font-bold" />

                    </div>

                </x-slot>

            </x-card>

        </x-modal>
    </div>
