<div>
    <div class="bg-white rounded-xl p-5">
        <div class=" flex justify-between">
            <header>
                <h1 class="text-xl font-bold text-gray-700 ">List of Appointment</h1>
                <p class="text-gray-500">{{ $appointment_count }} Appointment(s)</p>
            </header>
            {{-- <div class="flex space-x-2 items-center">
                <span>Default Day Slot: <span
                        class="font-bold text-lg text-red-600">{{ $slot->default_slot ?? 0 }}</span></span>
                <x-button.circle xs icon="pencil-alt" wire:click="openModal" dark />
            </div> --}}
        </div>
        <div class="mt-3">
            {{ $this->table }}
        </div>
    </div>
    <x-modal wire:model.defer="slot_modal" align="center">
        <x-card title="Default Slot">
            <div class="flex justify-center py-3">
                <div x-data="{ count: @entangle('count') }" class="flex items-center gap-x-3">

                    <x-button icon="minus" wire:click="minus" />



                    <span class="bg-teal-600 rounded-2xl text-white text-2xl px-5 py-1.5" wire:model="count"
                        x-text="count"></span>



                    <x-button wire:click="add" icon="plus" />

                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button dark label="Save Default" wire:click="saveDefault" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
