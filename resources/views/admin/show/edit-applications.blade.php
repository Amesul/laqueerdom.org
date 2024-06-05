<x-dashboard-layout
    :breadcrumbs="[['/show', 'Shows'], ['', $show->event->title], [null, 'Candidatures'],]">
    <x-slot:title>Modifier un show</x-slot:title>

    <x-glassmorphism class="my-6 px-8">
        @if($applications->count())
            <ul role="list" class="divide-y divide-primary/15">
                @foreach($applications as $application)
                    <li class="py-5" x-data="{ expanded: false }">
                        <header class="relative flex justify-between gap-x-6">
                            <div class="flex min-w-0 gap-x-4">
                                <x-profile-picture :user="$application->user" class="w-12 h-12"/>
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->profile->pseudo ?? $application->user->name }}</p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        <a href="mailto:{{ $application->user->email }}"
                                           class="relative truncate hover:underline">{{ $application->user->email }}</a>
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
                        <section x-show="expanded" x-collapse.duration.500ms class="text-primary text-sm space-y-2">
                            <p class="mt-3">{{ $application->description }}</p>
                            @if($application->accepted === null)
                                <div class="flex gap-2">
                                    <form id="accept-{{ $application->id }}" method="post" class="hidden"
                                          action="{{ route('admin.show.update-application', $application) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="accepted" :value="1">
                                    </form>
                                    <form id="refuse-{{ $application->id }}" method="post" class="hidden"
                                          action="{{ route('admin.show.update-application', $application) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="accepted" :value="0">
                                    </form>
                                    <x-danger-button type="submit" form="refuse-{{ $application->id }}">Refuser
                                    </x-danger-button>
                                    <x-secondary-button type="submit" form="accept-{{ $application->id }}">Accepter
                                    </x-secondary-button>
                                </div>
                            @endif
                        </section>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="py-5 font-medium">Il n'y a pas encore de candidatures.</p>
        @endif
    </x-glassmorphism>
</x-dashboard-layout>
