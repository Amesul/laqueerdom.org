@php use Illuminate\Support\Facades\Auth; @endphp
<x-dashboard-layout :breadcrumbs="[['/applications', 'Candidatures'], [null, 'Candidater']]">
    <x-slot:title>Candidater</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <form action="{{ route('artist.applications.store') }}" method="POST">
            @csrf

            <div class="space-y-6 mb-8">
                <!-- Show_id -->
                <div x-data="{ selectedShow: { id: null, title: 'Sélectionner un show' } }">
                    <x-input-label required for="show_id" :value="__('Show')"/>
                    <p class="text-xs text-red-600 font-bold">Il n'y a aucun booking en cours ou tu as déjà candidaté à
                        chacun d'entre eux.</p>
                    <input type="hidden" name="show_id" :value="selectedShow.id">
                    <div class="relative mt-2 max-w-80" x-data="{ openDropdown: false }">
                        <button {{ $shows->count() ? '' : 'disabled' }}
                                @click="openDropdown = !openDropdown"
                                type="button" aria-haspopup="listbox" aria-expanded="true"
                                aria-labelledby="listbox-label"
                                class="disabled:bg-striped disabled:cursor-not-allowed relative w-full cursor-default rounded-md bg-white pr-10 pl-3 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span class="block truncate" x-text="selectedShow.title"></span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"/>
                                </svg>
                            </span>
                        </button>
                        @if($shows->count())
                            <ul x-transition:enter="transition ease-in duration-100"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                x-show="openDropdown" @click.outside="openDropdown = false"
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                                aria-activedescendant="listbox-option-3">

                                @foreach($shows as $show)
                                    <li @click="openDropdown = false; selectedShow.id = {{ $show->id }}; selectedShow.title = '{{ $show->event->title }}'"
                                        id="listbox-option-0" role="option"
                                        class="relative cursor-default select-none py-2 pr-9 pl-3 text-gray-900 group hover:bg-accent-600 hover:text-white">
                                        <span class="block truncate"
                                              :class="selectedShow.id === {{ $show->id }} ? 'font-semibold' : 'font-normal'">{{ $show->event->title }}</span>
                                        <span x-show="selectedShow.id === {{ $show->id }}"
                                              class="absolute inset-y-0 right-0 flex items-center pr-4 text-accent-600 group-hover:text-white">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"/>
                                            </svg>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('show_id')"/>
                </div>

                <!-- Description -->
                <div>
                    <x-input-label required for="description" :value="__('Candidature')"/>
                    <x-tinymce.editor id="description" name="description" type="text" :value="old('description')"
                                      class="mt-1 block w-full simple-wysiwyg"/>
                    <x-input-error :messages="$errors->get('description')"/>
                </div>
            </div>
            <div class="ml-auto flex w-fit gap-4">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Candidater</x-primary-button>
            </div>
        </form>
    </x-glassmorphism>
</x-dashboard-layout>
