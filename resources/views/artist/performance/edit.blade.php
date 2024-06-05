@php use Illuminate\Support\Facades\Storage; @endphp
<x-dashboard-layout
    :breadcrumbs="[['/performances', 'Performances'], ['', $performance->title], [null, 'Modifier'],]">
    <x-slot:title>Modifier une performance</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <form action="{{ route('artist.performances.update', $performance) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="space-y-8">
                <!-- Title -->
                <div class="max-w-xl">
                    <x-input-label required for="title" :value="__('Titre')"/>
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                  :value="old('title', $performance->title)"
                                  required autofocus/>
                    <x-input-error :messages="$errors->get('title')"/>
                </div>

                <!-- Duration -->
                <div class="w-fit">
                    <x-input-label for="duration" :value="__('Durée')"/>
                    <p class="text-xs text-slate-500">Durée approximative de ta performance (en hh:mm:ss), pour estimer
                        la durée du show.</p>
                    <x-text-input id="duration" name="duration" type="text" class="mt-1 block w-full"
                                  pattern="\d\d:\d\d:\d\d" placeholder="00:00:00"
                                  :value="old('duration', $performance->duration)" autofocus/>
                    <x-input-error :messages="$errors->get('duration')"/>
                </div>

                <!-- Description -->
                <div class="col-span-full">
                    <x-input-label for="description" :value="__('Description')"/>
                    <p class="text-xs text-slate-500">Présentation à destination des hosts pour présenter ton
                        passage.</p>
                    <x-tinymce.editor id="description" name="description"
                                      class="simple-wysiwyg">{{ old('description', $performance->description) }}</x-tinymce.editor>
                    <x-input-error :messages="$errors->get('description')"/>
                </div>

                <!-- Stage requirements -->
                <div>
                    <x-input-label for="stage_requirements" :value="__('Besoins scéniques')"/>
                    <p class="text-xs text-slate-500">Changements de plateau avant et pendant (e.g. : besoin d'un micro,
                        une table à installer...).</p>
                    <x-tinymce.editor id="stage_requirements" name="stage_requirements"
                                      class="simple-wysiwyg">{{ old('stage_requirements', $performance->stage_requirements) }}</x-tinymce.editor>
                    <x-input-error :messages="$errors->get('stage_requirements')"/>
                </div>

                <!-- Others -->
                <div>
                    <x-input-label for="others" :value="__('Autres')"/>
                    <p class="text-xs text-slate-500">Préférence d'ordre de passage, remarques ou demande de
                        matériel entre artiste.</p>
                    <x-tinymce.editor id="others" name="others" class="simple-wysiwyg"
                                      autofocus>{{ old('others', $performance->others) }}</x-tinymce.editor>
                    <x-input-error :messages="$errors->get('others')"/>
                </div>

                <!-- File -->
                <div>
                    <x-input-label for="file" :value="__('Fichier')"/>

                    @if($performance->file)
                        @if(str_contains(Storage::mimeType($performance->file), 'audio'))
                            <audio preload="none" class="max-w-xl my-2 w-full" controls
                                   src="{{ asset($performance->file) }}"></audio>
                        @endif
                        @if(str_contains(Storage::mimeType($performance->file), 'video'))
                            <video preload="none" class="max-w-xl my-2 w-full" controls
                                   src="{{ asset($performance->file) }}"></video>
                        @endif
                    @endif

                    <x-file-input id="file" name="file" accept="audio/*, video/*"/>
                    <x-input-error :messages="$errors->get('file')"/>
                </div>
            </div>
            <div class="flex gap-4 mt-8 ml-auto w-fit">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    </x-glassmorphism>
</x-dashboard-layout>
