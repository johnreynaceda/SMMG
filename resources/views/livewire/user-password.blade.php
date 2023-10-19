<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">


        <div class="col-span-6 sm:col-span-4">
            <span>New Password</span>
            <x-input id="password" type="password" wire:model="new_password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <span>Confirm Password</span>
            <x-input id="password_confirmation" type="password" wire:model="confirm_password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button label="Save" wire:click="save" spinner="save" />
    </x-slot>
</x-form-section>
