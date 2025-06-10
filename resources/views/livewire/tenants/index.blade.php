<?php

use Livewire\Volt\Component;
use App\Models\Tenant;

new class extends Component {
    public $tenants;
    // public $tenantId;

    public function mount()
    {
        $this->tenants = Tenant::all();
    }

    public function destroy(array $tenant)
    {
        try {
            $tenant = Tenant::findOrFail($tenant['id']);
            $tenant->delete();
            $this->tenants = Tenant::all();
            session()->flash('success', 'Inquilino eliminado con éxito.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el inquilino: ' . $e->getMessage());
        }
    }
};
?>

<div>
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Tenants</h2>
        <a href="{{ route('tenants.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-gray-900">
            Add Tenant
        </a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Dominio</th>
                    <th scope="col" class="px-6 py-3">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    <tr wire:key="tenant-{{ $tenant->id }}"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $tenant->id }}
                        </th>
                        <td class="px-6 py-4">
                            @if ($tenant->domains->isNotEmpty())
                                {{ $tenant->domains->first()->domain }}
                            @else
                                No domain assigned
                            @endif
                        </td> <!-- Cierre de etiqueta corregido -->
                        <td class="px-6 py-4">
                             <flux:button variant="primary" class="mr-2"
                                href="{{ route('tenants.edit', $tenant) }}">
                                {{ __('Edit') }}
                            </flux:button>

                            <button type="button" wire:click="destroy({{ $tenant }})"
                                class="text-red-500 hover:underline ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
