<div x-data>
    <div class="grid grid-cols-3 gap-4">
        @forelse ($appointments as $key => $item)
            <div class="bg-white p-5 relative rounded-xl shadow-xl">
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/doctor.png') }}" class="h-12 w-12 bg-red-500 rounded-full" alt="">
                    <div class="flex-1">
                        <div class="flex justify-between  space-x-3">
                            <h1 class="uppercase font-bold text-gray-700">{{ $item->user->name }}</h1>

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
                        @if ($item->checkup != null)
                            <x-button label="Print Form" rounded dark xs icon="printer"
                                wire:click="printForm({{ $item->id }})" />
                        @else
                            <x-button wire:key="{{ $key }}" label="Fill-Out Form"
                                wire:click="openFormModal({{ $item->id }})"
                                spinner="openFormModal({{ $item->id }})" right-icon="document-text" rounded sm
                                outline positive />
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-2">
                <h1>No data</h1>
            </div>
        @endforelse
    </div>
    <x-modal.card title="FILL-OUT FORM" fullscreen blur wire:model.defer="form_modal">
        <div class="mx-auto max-w-7xl ">
            <div class="border relative rounded-3xl py-5 px-10 shadow-xl">
                <img src="{{ asset('images/logo.png') }}" class="absolute right-0 bottom-0 opacity-10 h-20"
                    alt="">
                <div class="flex space-x-4 items-center">
                    <img src="{{ asset('images/doctor.png') }}" class="h-40 w-40 bg-red-500 rounded-full"
                        alt="">
                    <div>
                        <h1 class="text-xl font-bold text-green-600">FILL-OUT CHECKUP FORM </h1>
                        <h1 class=" font-bold uppercase text-gray-600">{{ $appointment_data->user->name ?? null }}</h1>
                        <h1 class=" text-gray-600">
                            {{ \Carbon\Carbon::parse($appointment_data->appointment_date ?? null)->format('F d, Y h:i A') }}
                        </h1>
                        <p class="text-justify">Condition: {{ $appointment_data->condition ?? null }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 rounded-3xl border shadow-xl px-10 py-8">
                {{ $this->form }}
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4 m-auto max-w-7xl">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary rounded right-icon="save" class="font-semibold" label="Save Form"
                        wire:click="saveForm" spinner="saveForm" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

    <x-modal wire:model.defer="result_data" align="center" max-width="4xl">
        <x-card title="CHECK-UP RESULT">
            <div x-ref="printContainer">
                <div class="mx-auto max-w-7xl ">
                    <div class="border relative  py-5 px-10 ">
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
                    <div class="mt-5 border px-10 py-8">
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
                                @if ($hr_attachment != null)
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
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="PRINT FORM" dark right-icon="printer"
                        @click="printOut($refs.printContainer.outerHTML);" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
