<x-dashboard-layout :breadcrumbs="[[null, 'Candidatures'],]">
    <x-slot:title>Candidatures</x-slot:title>

    <x-slot:quickAction>
        <x-dashboard.quick-action link="/applications/create">Candidater</x-dashboard.quick-action>
    </x-slot:quickAction>

    <x-glassmorphism class="my-6">
        @if($applications->count())
            <ul role="list" class="divide-y divide-primary/15">
                @foreach($applications as $application)
                    <li class="py-5" x-data="{ expanded: false }">
                        <header class="relative flex justify-between gap-x-6">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->show->event->title }}</p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        {{ $application->show->event->venue->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-4">
                                @if($application->accepted === null)
                                    <span
                                        class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600">En attente</span>
                                @elseif($application->accepted)
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Acceptée</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">Rejetée</span>
                                @endif
                                <button @click="expanded = ! expanded">
                                    <span class="sr-only">Ouvrir la description</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         :class="expanded ? 'rotate-90' : ''"
                                         class="h-5 w-5 flex-none text-primary/50 transition-all duration-500 ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </button>
                            </div>
                        </header>
                        <section x-show="expanded" x-collapse.duration.500ms
                                 class="text-primary text-sm space-y-2 mt-3">
                            {!! $application->description  !!}
                        </section>
                    </li>
                @endforeach

            </ul>
        @else
            <div>
                <p class="font-bold p-8">
                    Tu n'as pas encore candidaté à un booking.
                </p>
            </div>
        @endif
    </x-glassmorphism>

    {{ $applications->render() }}
</x-dashboard-layout>
