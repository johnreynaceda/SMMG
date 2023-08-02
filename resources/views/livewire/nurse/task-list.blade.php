<div>
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
                            <x-badge />
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
</div>
