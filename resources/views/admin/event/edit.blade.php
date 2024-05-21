<x-dashboard-layout :breadcrumbs="[
    ['/events', 'Événements'],
    [null, $event->title],
    ['/events/' . $event->id . '/edit', 'Modifier '],
    ]">
    <x-slot:title>Modifier un événement</x-slot:title>

    <x-glassmorphism class="p-8">
        <form action="{{ route('admin.events.update', $event) }}" method="post">
            @csrf
            @method('PATCH')

            <input type="hidden" name="type" value="{{ $event->type }}">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

                <!-- Title -->
                <div class="col-span-1 md:col-span-2">
                    <x-input-label required for="title" :value="__('Titre')"/>
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full text-primary" required
                                  :value="old('title', $event->title)"/>
                    <x-input-error :messages="$errors->get('title')"/>
                </div>

                <!-- Date -->
                <div class="col-span-1">
                    <x-input-label required for="date" :value="__('Date')"/>
                    <x-text-input id="date" name="date" type="datetime-local" class="mt-1 block w-full text-primary"
                                  :value="old('date', $event->date)" required/>
                    <x-input-error :messages="$errors->get('date')"/>
                </div>

                <!-- Price -->
                <div class="col-span-1 col-start-1">
                    <x-input-label for="price" :value="__('Prix')"/>
                    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full text-primary"
                                  :value="old('price', $event->price)"/>
                    <p class="mt-1 text-xs text-secondary-400">Pour définir l'événement comme gratuit, rentrer 0.
                        Laisser vide pour indiquer un prix libre.</p>
                    <x-input-error :messages="$errors->get('price')"/>
                </div>

                <!-- Venue -->
                <div class="col-span-1 col-start-1 md:col-start-3"
                     x-data="{ selection_id: '{{ $event->venue->id }}', selection_value: '{{ $event->venue->name }}' }">
                    <x-input-label for="venue_id" :value="__('Structure')"/>
                    <input type="hidden" name="venue_id" :value="selection_id">
                    <x-dropdown align="left" width="full">
                        <x-slot:trigger>
                            <button type="button"
                                    class="mt-1 inline-flex w-full items-center justify-between rounded-md border bg-white text-primary px-4 py-2 text-start shadow-sm border-secondary-200 focus:border-accent focus:ring-indigo-500">
                                <span x-text="selection_value"></span>
                                <svg class="-mr-1 h-6 w-6 text-secondary-200" fill="currentColor" viewBox="0 0 20 20"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"/>
                                </svg>
                            </button>
                        </x-slot:trigger>
                        <x-slot:content>
                            <ul class="w-full divide-y divide-secondary/10">
                                @foreach($venues as $venue)
                                    <li class="w-full px-4 py-2 hover:bg-slate-100 text-primary">
                                        <button type="button"
                                                @click="selection_id = '{{ $venue->id }}'; selection_value = '{{ $venue->name }}';">{{ $venue->name }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </x-slot:content>
                    </x-dropdown>
                    <x-input-error :messages="$errors->get('venue_id')"/>
                </div>

                <!-- Description -->
                <div class="col-span-full">
                    <x-input-label for="description" class="mb-1" :value="__('Description')"/>
                    <x-tinymce.editor name="description" id="description"
                                      class="wysiwyg">{{ old('description', $event->description) }}</x-tinymce.editor>
                    <x-input-error :messages="$errors->get('description')"/>
                </div>

                <!-- Thumbnail -->
                <div class="col-span-full">
                    <x-input-label for="thumbnail" :value="__('Affiche')"/>
                    <input id="thumbnail" name="thumbnail" type="file"
                           class="mt-1 block w-full file:rounded-full file:border-none file:px-3 file:py-1 file:font-bold capitalize file:bg-accent-300 file:text-primary hover:file:bg-accent-500 hover:file:text-primary hover:file:cursor-pointer"/>
                    <x-input-error :messages="$errors->get('thumbnail')"/>
                </div>
            </div>
            <div class="mt-12 flex justify-between">
                <div class="w-fit" x-data="{ openSelectMenu: false, published: {{ $event->published }} }">
                    <label id="listbox-label" class="sr-only">Modifier la visibilité</label>
                    <div class="relative">
                        <div class="inline-flex rounded-md shadow-sm divide-x divide-accent-600">
                            <div
                                class="inline-flex items-center rounded-l-md px-3 py-2 text-white shadow-sm bg-accent gap-x-1.5">
                                <svg class="h-5 w-5 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"/>
                                </svg>
                                <p class="text-sm font-bold" x-text="published ? 'Publié' : 'Brouillons'"></p>
                            </div>
                            <button type="button" @click="openSelectMenu = !openSelectMenu"
                                    class="inline-flex items-center rounded-r-md rounded-l-none p-2 bg-accent hover:bg-accent-600 focus:ring-accent focus:ring-offset-secondary-100/50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <span class="sr-only">Modifier la visibilité</span>
                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>

                        <ul x-show="openSelectMenu" @click.outside="openSelectMenu = false"
                            x-transition:enter="transition ease-in duration-100"
                            x-transition:enter-start="opacity-0 scale-50"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute left-0 bottom-10 z-20 mt-2 w-72 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-secondary-100 focus:outline-none"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                            aria-activedescendant="listbox-option-0">

                            <li @click="published = true"
                                class="cursor-default select-none p-4 text-sm transition-all text-primary group hover:bg-accent"
                                id="listbox-option-0" role="option">
                                <div class="flex flex-col">
                                    <div class="flex justify-between">
                                        <p :class="published == false ? 'font-bold' : 'font-normal'"
                                           class="group-hover:text-white">Publié</p>
                                        <span x-show="published == true"
                                              class="transition-all text-accent group-hover:text-white">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="mt-2 transition-all text-slate-500 group-hover:text-slate-300">
                                        L'événement est visible par tout le monde dans l'agenda</p>
                                </div>
                            </li>

                            <li @click="published = false"
                                class="cursor-default select-none p-4 text-sm transition-all text-primary group hover:bg-accent"
                                id="listbox-option-0" role="option">
                                <div class="flex flex-col">
                                    <div class="flex justify-between">
                                        <p :class="published == false ? 'font-bold' : 'font-normal'"
                                           class="group-hover:text-white">
                                            Brouillons</p>
                                        <span x-show="published == false"
                                              class="transition-all text-accent group-hover:text-white">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <p class="mt-2 transition-all text-slate-500 group-hover:text-slate-300">
                                        L'évènement n'est pas visible dans l'agenda</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="published" :value="published">
                </div>
                <div class="flex gap-4">
                    <x-secondary-button>Annuler</x-secondary-button>
                    <x-primary-button>Enregistrer</x-primary-button>
                </div>
            </div>
        </form>
    </x-glassmorphism>
</x-dashboard-layout>
