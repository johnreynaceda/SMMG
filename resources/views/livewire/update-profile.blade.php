<div>
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" required
                    autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="email" class="mt-1 block w-full" wire:model="email" required
                    autocomplete="name" />
                <x-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="number" class="mt-1 block w-full" wire:model="phone_number" required
                    autocomplete="name" />
                <x-input-error for="phone_number" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
