<div>
    <div>
        {{ $this->form }}
        <div class="mt-5">
            <x-button label="Update" wire:click="updateProfile" right-icon="save" spinner="updateProfile" outline rounded
                positive class="font-bold uppercase" />
        </div>
    </div>
</div>
