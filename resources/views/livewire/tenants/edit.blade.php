<?php

use Livewire\Volt\Component;
use App\Models\Tenant;

new class extends Component {
    public Tenant $tenant;
    public string $id = '';

    public function mount(Tenant $tenant): void
    {
        $this->tenant = $tenant;
        $this->id = $tenant->id;
    }

    public function update()
    {
        $this->tenant->update(['id' => $this->id]);
        return redirect()->route('tenants.index');
    }
}; ?>

<div>
    <form wire:submit="update" class="flex flex-col gap-6">
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
