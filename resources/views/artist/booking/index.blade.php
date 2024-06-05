<x-dashboard-layout :breadcrumbs="[[null, 'Booking'],]">
    <x-slot:title>Booking</x-slot:title>

    <x-glassmorphism class="my-6 px-8">
        @if($shows->count())
            <ul role="list" class="rounded-md divide-y divide-primary/10 py-2">
                @foreach($shows as $show)
                    <li class="flex justify-between gap-x-6 py-4">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-secondary-900">
                                    <a href="{{ route('artist.booking.show', $show->event) }}"
                                       class="hover:underline">{{ $show->event->title }}</a>
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-secondary-500">
                                    <time
                                        datetime="{{$show->event->date->format('Y/m/d H:i')}}">{{ ucfirst($show->event->date->translatedFormat('D j F Y')) }}
                                        · {{ $show->event->date->translatedFormat('H:i') }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-6" x-data="{openOptions: false}">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-secondary-900">{{ $show->event->venue->name }}</p>
                                <p class="mt-1 text-xs leading-5 text-secondary-500">{{ $show->event->venue->city }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div>
                <p class="font-bold py-8">
                    Il n'y aucun booking ouvert actuellement.
                </p>
            </div>
        @endif

    </x-glassmorphism>
</x-dashboard-layout>
