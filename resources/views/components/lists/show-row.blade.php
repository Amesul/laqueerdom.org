@props([
    'show'
])

<li class="flex justify-between gap-x-6 py-4">
    <div class="flex min-w-0 gap-x-4">
        <div class="flex min-w-0 flex-auto flex-col">
            <div class="inline-flex gap-x-2 text-sm items-baseline font-semibold leading-6 text-primary">
                <p>{{ $show->event->title }}</p>
                <p class="truncate text-xs font-normal text-primary-500">
                    <time
                        datetime="{{$show->event->date->format('Y/m/d H:i')}}">{{ ucfirst($show->event->date->translatedFormat('d/m/y')) }}
                        · {{ $show->event->date->translatedFormat('H:i') }}</time>
                </p>
            </div>
            <div class="mt-1 inline-flex items-center text-xs leading-5 gap-x-1.5 text-secondary-500">
                <p>Deadline :</p>
                <p>
                    <time
                        datetime="{{ $show->deadline->format('Y-m-d') }}T00:00Z">{{ $show->deadline->translatedFormat('D j F Y') }}</time>
                </p>
            </div>
        </div>
    </div>

    <div class="flex shrink-0 items-center gap-x-6" x-data="{openOptions: false}">
        <div class="hidden sm:flex sm:flex-col sm:items-end">
            <p class="text-sm leading-6 text-secondary-900">{{ $show->event->venue->name }}</p>
            <p class="mt-1 text-xs leading-5 text-secondary-500">
                @if($show->applications_open)
                    <span
                        class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Booking ouvert</span>
                @else
                    <span
                        class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">Booking fermé</span>
                @endif
            </p>
        </div>
        <div class="relative flex-none">
            <button @click="openOptions = !openOptions"
                    type="button" class="block -m-2.5 p-2.5 text-secondary-500 hover:text-secondary-900"
                    id="options-button" aria-expanded="false" aria-haspopup="true">
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
                 role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button"
                 class="absolute -top-1/2 right-6 z-10 w-48 origin-center rounded-md bg-white shadow-xl ring-1 ring-secondary/5 text-secondary-800/5 focus:outline-none">

                @if($show->event->date > now())
                    <a href="{{ route('admin.shows.edit', $show) }}"
                       class="block rounded-t-md px-3 py-2 text-sm leading-6 text-secondary-900 hover:bg-secondary-100"
                       role="menuitem" tabindex="-1" id="options-item-0">Modifier<span
                            class="sr-only">, {{ $show->event->title }}</span></a>
                @else
                    <p class="block rounded-b-md px-3 py-2 text-sm leading-6 text-primary/75 cursor-not-allowed bg-striped"
                       role="menuitem" tabindex="-1" id="options-item-0">Modifier<span
                            class="sr-only">, {{ $show->event->title }}</span></p>
                @endif
                <a href="{{ route('admin.shows.edit-performances', $show) }}"
                   class="block px-3 py-2 text-sm leading-6 text-secondary-900 hover:bg-secondary-100"
                   role="menuitem"
                   tabindex="-1" id="options-item-1">Performances<span
                        class="sr-only">, {{ $show->event->title }}</span></a>
                @if(!$show->applications_open && !$show->applications->count())
                    <p class="block rounded-b-md px-3 py-2 text-sm leading-6 text-primary/75 cursor-not-allowed bg-striped"
                       role="menuitem" tabindex="-1" id="options-item-2">Candidatures<span
                            class="sr-only">, {{ $show->event->title }}</span></p>
                @else
                    <a href="{{ route('admin.shows.edit-applications', $show) }}"
                       class="block rounded-b-md px-3 py-2 text-sm leading-6 text-secondary-900 hover:bg-secondary-100"
                       role="menuitem"
                       tabindex="-1" id="options-item-2">Candidatures<span
                            class="sr-only">, {{ $show->event->title }}</span></a>
                @endif
            </div>
        </div>
    </div>
</li>
