<div>
    {{-- <div class="p-5">

    </div> --}}
    <header class="px-10 text-xl font-bold text-gray-600">MY PROFILE</header>
    <div class="py-5 px-10">
        <div class="bg-white p-10 rounded-lg">
            {{ $this->form }}
            <div class="mt-5">
                @if (auth()->user()->patient_profile == null)
                    <x-button label="Submit" dark icon="save" class="font-semibold" wire:click="submitProfile" />
                @else
                    <x-button label="Update" positive icon="save" class="font-semibold" wire:click="updateProfile" />
                @endif
            </div>
        </div>
    </div>
</div>
