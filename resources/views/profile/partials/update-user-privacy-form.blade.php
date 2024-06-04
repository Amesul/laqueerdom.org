@php use Illuminate\Support\Facades\Auth; @endphp
@php $user = Auth::user() @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Confidentialité du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Modifier la visibilité des informations de profil') }}
        </p>
    </header>

    <form method="post" action="{{ route('privacy.update') }}" class="mt-6 space-y-6">
        @csrf @method('PATCH')
        <fieldset>
            <legend class="text-sm font-semibold leading-6 text-gray-900">Visibilité du compte</legend>
            <p class="text-xs text-gray-500"><span class="font-bold">Privé :</span> aucune information n'est visible des
                autres utilisateurs ou du public, excepté les membres du staff</p>
            <p class="text-xs text-gray-500"><span class="font-bold">Public :</span> le profil est accessible depuis le
                site web (sans données de contact) et depuis l'annuaire interne</p>
            <p class="text-xs text-gray-500"><span class="font-bold">Site web uniquement :</span> le profil artiste
                (biographie, photos, pronoms...) sans données de contact est visible uniquement dans la page <a
                    class="underline hover:text-gray-800" href="{{ route('about.artists') }}">À propos</a>.</p>
            <p class="text-xs text-gray-500"><span class="font-bold">Annuaire uniquement :</span> les données de contact
                sont visibles dans <a class="underline hover:text-gray-800"
                                      href="{{ route('artist.directory') }}">l'annuaire</a> partagé entre les artistes
                enregistré. </p>
            <div class="mt-3 space-y-3">
                <x-radio-button field-name="privacy" element-name="private"
                                checked="{{ $user->privacy === 'private'  ? 'checked' : '' }}">Privé
                </x-radio-button>
                <x-radio-button field-name="privacy" element-name="public"
                                checked="{{ $user->privacy === 'public'  ? 'checked' : '' }}">Public
                </x-radio-button>
                <x-radio-button field-name="privacy" element-name="website_only"
                                checked="{{ $user->privacy === 'website_only'  ? 'checked' : '' }}">Site web uniquement
                </x-radio-button>
                <x-radio-button field-name="privacy" element-name="directory_only"
                                checked="{{ $user->privacy === 'directory_only'  ? 'checked' : '' }}">Annuaire
                    uniquement
                </x-radio-button>
            </div>
        </fieldset>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'settings-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
