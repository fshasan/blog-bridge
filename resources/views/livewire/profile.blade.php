<div>
    <form wire:submit.prevent="updateProfile" class="mt-6 space-y-6">
        @csrf
        {{ $user->name }}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.lazy="user.name" id="name" name="name" type="text" class="mt-1 block w-full"
                required autofocus autocomplete="name" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model.lazy="user.email" id="email" name="email" type="email"
                class="mt-1 block w-full" required autocomplete="email" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
