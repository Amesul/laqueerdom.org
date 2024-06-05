<x-dashboard-layout :breadcrumbs="[]">
    <x-slot:title>{{ $performance->title }}</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <header>
            <h2>{{ $performance->title }}</h2>
            <h4>{{ $performance->user->profile->pseudo ?? $performance->user->name }}</h4>
        </header>

        <article>
            {{-- TODO: Display performance details --}}
        </article>
    </x-glassmorphism>
</x-dashboard-layout>
