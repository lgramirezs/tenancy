<x-layouts.app :title="__('Tenants')">
    <h1>Tenancy</h1>
    @foreach ($tenants as $tenant)
    <div class="mb-4">
        <h2>{{ $tenant->id }}</h2>
        <p>{{ $tenant->domains->first()->domain ?? '' }}</p>
        <a href="{{ route('tenants.edit', $tenant) }}" class="text-blue-500 hover:underline">Edit</a>
    </div>
    @endforeach
</x-layouts.app>