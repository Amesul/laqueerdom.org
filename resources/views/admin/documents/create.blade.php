<x-dashboard-layout :breadcrumbs="[['/documents', 'Documents'], ['' , 'Créer']]">

    <x-slot:title>Créer un document</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <form action="{{ route('admin.documents.store') }}" method="post" class="grid grid-cols-2 gap-8">
            @csrf

            <!-- Title -->
            <div class="col-span-full md:col-span-1">
                <x-input-label required for="title" :value="__('Titre')"/>
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')"
                              required autofocus autocomplete="title"/>
                <x-input-error :messages="$errors->get('title')"/>
            </div>

            <!-- Type -->
            <div class="col-span-full md:col-span-1">
                <fieldset>
                    <legend
                        class="block after:content-['*'] after:ml-1 after:text-red-500 font-bold text-sm text-secondary-700 mb-1">
                        Type
                    </legend>
                    <x-radio-button element-name="debriefing" field-name="type">Compte-rendu de réunion</x-radio-button>
                    <x-radio-button element-name="general_assembly" field-name="type">Assemblée générale
                    </x-radio-button>
                    <x-radio-button element-name="administration_meeting" field-name="type">Conseil d'administration
                    </x-radio-button>
                    <x-radio-button element-name="note" field-name="type">Note</x-radio-button>
                    <x-input-error :messages="$errors->get('type')"/>
                </fieldset>
            </div>

            <!-- Content -->
            <div class="col-span-full">
                <x-input-label for="content" class="sr-only" :value="__('Contenu')"/>
                <x-tinymce.editor id="content" name="content" type="text"
                                  class="mt-1 block w-full resize-y advanced-wysiwyg"
                                  :value="old('content')" rows="30" autofocus autocomplete="content"/>
                <x-input-error :messages="$errors->get('content')"/>
            </div>

            <div class="flex gap-4 col-span-full">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Créer</x-primary-button>
            </div>

        </form>
    </x-glassmorphism>
</x-dashboard-layout>
