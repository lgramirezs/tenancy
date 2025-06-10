<?php

use Livewire\Volt\Component;
use App\Models\Tenant;
use Illuminate\Auth\Events\Registered;

new class extends Component {
    public string $id = '';

    public function register(): void
    {

        $this->validate([
            'id' => ['required', 'string', 'max:255'],
        ]);

        $tenant = Tenant::create(['id' => $this->id]);
        $tenant->domains()->create(['domain' => $this->id . '.localhost']);

        event(new Registered($tenant));

        $this->redirect(route('tenants.index'), navigate: true);
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
