@php $user = Illuminate\Support\Facades\Auth::user(); $profile = $user->profile @endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Paramètres du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Modifier les paramètres du profil.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 grid-cols-2 gap-6 grid"
          enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="">
            <x-input-label for="profile_picture" :value="__('Photo de profil')"/>
            @isset($profile->profile_picture)
                <img src="{{ asset($profile->profile_picture) }}" class="rounded-full h-36 w-36 object-cover my-4"
                     alt="Photo de profil">
            @endisset
            <x-secondary-button class="mt-1">
                <label class="hover:cursor-pointer" x-data="{ files: null }">
                    <input id="profile_picture" name="profile_picture" type="file" accept="image/*" class="sr-only"
                           x-on:change="files = Object.values($event.target.files)">
                    <span x-text="files ? files.map(file => file.name).join(', ') : 'Choisir une image'"></span>
                </label>
            </x-secondary-button>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')"/>
        </div>

        @if($user->hasRole('admin'))
            <div class="mt-6 col-start-1">
                <x-input-label for="job" :value="__('Poste')" :required="true"/>
                <p class="text-xs text-gray-500">Rôle au sein de l'association</p>
                <x-text-input id="job" name="job" type="text" class="mt-1 block w-full"
                              :value="old('job', $profile->job)" autofocus required/>
                <x-input-error class="mt-2" :messages="$errors->get('job')"/>
            </div>
        @endif

        <div class="col-start-1">
            <x-input-label for="pseudo" :value="__('Nom de scène')"/>
            <x-text-input id="pseudo" name="pseudo" type="text" class="mt-1 block w-full"
                          :value="old('pseudo', $profile->pseudo)" autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('pseudo')"/>
        </div>


        <div class="col-start-1">
            <x-input-label for="pronouns" :value="__('Pronoms')"/>
            <x-text-input id="pronouns" name="pronouns" type="text" class="mt-1 block w-full"
                          :value="old('pronouns', $profile->pronouns)"
                          autofocus autocomplete="pronouns"/>
            <x-input-error class="mt-2" :messages="$errors->get('pronouns')"/>
        </div>

        <div class="col-start-1">
            <x-input-label for="link" :value="__('Site web ou réseau social')"/>
            <x-text-input id="link" name="link" type="text" class="mt-1 block w-full"
                          :value="old('link', $profile->link)"/>
            <x-input-error class="mt-2" :messages="$errors->get('link')"/>
        </div>

        <div class="col-start-1 col-span-2">
            <x-input-label for="biography" class="mb-1" :value="__('Biographie')"/>
            <x-tinymce.editor id="biography" class="wysiwyg "
                              name="biography">{!! $profile->biography !!}</x-tinymce.editor>
            <x-input-error class="mt-2" :messages="$errors->get('biography')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
