<x-dashboard-layout
    :breadcrumbs="[['/booking', 'Booking'],[null, $event->title],]">
    <x-slot:title>{{ $event->title }}</x-slot:title>

    <x-glassmorphism class="my-6 p-8 space-y-8">
        <header>
            <h2 class="text-lg font-bold">{{ $event->title }}</h2>

            <p>
                <time
                    datetime="{{ $event->date->format('c') }}">{{ ucfirst($event->date->translatedFormat('l j F Y')) }},
                    à {{ $event->date->translatedFormat('H:i') }}</time>
            </p>
        </header>

        <section>
            <p class="font-bold">{{ $event->venue->name }}</p>
            <p>{{ $event->venue->address }}</p>
            @isset($event->venue->address2 )
                <p>{{ $event->venue->address2 }}</p>
            @endisset
            <p>{{ $event->venue->zip_code }} {{ $event->venue->city }}, {{ $event->venue->country }}</p>
        </section>

        @isset($event->description)
            <article class="space-y-4">
                {!! $event->description !!}
            </article>
        @endisset
    </x-glassmorphism>
</x-dashboard-layout>
