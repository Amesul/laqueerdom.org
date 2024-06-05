<x-dashboard-layout :breadcrumbs="[[null, 'Partenaires'],]">
    <x-slot:title>Partenaires</x-slot:title>

    <x-slot:quick-action>
        <x-dashboard.quick-action link="{{ route('admin.venues.create') }}"/>
    </x-slot:quick-action>

     <x-glassmorphism role="list" class="my-6" x-data="tabs">
        <ul role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
            @foreach($venues as $venue)
                <x-lists.venue-row :venue="$venue"/>
            @endforeach
        </ul>
    </x-glassmorphism>
</x-dashboard-layout>
