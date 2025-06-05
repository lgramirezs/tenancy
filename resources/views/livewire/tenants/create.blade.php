<?php

use Livewire\Volt\Component;
use App\Models\Tenant;
use Illuminate\Auth\Events\Registered;

new class extends Component {
    public string $id = '';

    public function register(): void
    {
        // Example: Validate and handle registration logic
        $validated = $this->validate([
            'id' => 'required|string|max:255',
        ]);

        event(new Registered(($tenant = Tenant::create($validated))));

        $this->redirectIntended(route('tenants.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="id" :label="__('Name')" type="text" required autofocus autocomplete="name"
            placeholder="{{ __('Full name') }}" />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>
