@php use App\Models\Event; @endphp
@props([
    /** @var Event */
    'event'
])

<li class="flex justify-between gap-x-6 py-4">
    <div class="flex min-w-0 gap-x-4">
        <div class="min-w-0 flex-auto">
            <p class="text-sm font-semibold leading-6 text-secondary-900">
                <a href="{{ route('agenda.show', $event) }}" class="hover:underline">{{ $event->title }}</a>
            </p>
            <p class="mt-1 flex text-xs leading-5 text-secondary-500">
                <time
                    datetime="{{$event->date->format('Y/m/d H:i')}}">{{ ucfirst($event->date->translatedFormat('D j F Y')) }}
                    · {{ $event->date->translatedFormat('H:i') }}</time>
            </p>
        </div>
    </div>
    <div class="flex shrink-0 items-center gap-x-6" x-data="{openOptions: false}">
        <div class="hidden sm:flex sm:flex-col sm:items-end">
            <p class="text-sm leading-6 text-secondary-900">{{ $event->venue->name }}</p>
            <p class="mt-1 text-xs leading-5 text-secondary-500">{{ $event->venue->city }}</p>
        </div>
        <div class="relative flex-none">
            <button @click="openOptions = !openOptions"
                    type="button" class="block -m-2.5 p-2.5 text-secondary-500 hover:text-secondary-900"
                    id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Ouvrir les options</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"/>
                </svg>
            </button>

            <div x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 x-show="openOptions" @click.outside="openOptions = false" tabindex="-1"
                 role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                 class="absolute -top-1/2 right-6 z-10 w-32 origin-center rounded-md bg-white shadow-xl ring-1 ring-secondary/5 text-secondary-800/5 focus:outline-none">

                <a href="{{ route('admin.events.edit', $event) }}"
                   class="block rounded-t-md px-3 py-2 text-sm leading-6 text-secondary-900 hover:bg-secondary-100"
                   role="menuitem"
                   tabindex="-1" id="options-menu-0-item-0">Modifier<span
                        class="sr-only">, {{ $event->title }}</span></a>
                <form action="{{ route('admin.events.destroy', $event) }}" method="post"
                      class="block rounded-b-md px-3 py-2 text-sm leading-6 text-secondary-900 hover:bg-red-100">
                    @csrf @method('DELETE')
                    <button role="menuitem" tabindex="-1" id="options-menu-0-item-1">
                        Supprimer<span class="sr-only">, {{ $event->title }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</li>
