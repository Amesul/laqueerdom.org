@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Paramètres du compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Modifier les paramètres du compte et le mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('privacy.update') }}" class="mt-6 space-y-6 grid grid-cols-3">
        @csrf
        @method('patch')

        <div class="col-span-3">
            <x-input-label for="name" :value="__('Nom')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div class="col-span-3">
            <x-input-label for="username" :value="__('Nom d\'utilisateur·ice')"/>
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                          :value="old('username', $user->username)"
                          required autofocus autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('username')"/>
        </div>

        <div class="col-span-3 sm:col-span-2 col-start-1">
            <x-input-label for="email" :value="__('Courriel')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="email"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Cette adresse mail n\'est pas vérifiée.') }}

                        <button form="send-verification"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Envoyer un lien de vérification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('Un lien de vérification a été envoyé !') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-span-3 sm:col-span-2 col-start-1">
            <label for="phone" class="block text-sm w-full font-medium leading-6 text-gray-900">Phone Number</label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 flex items-center">
                    <label for="phone_country" class="sr-only">Indicateur du pays</label>
                    <select id="phone_country" name="phone_country" autocomplete="phone_country"
                            class="h-full rounded-md border-0 bg-transparent py-0 pr-7 pl-3 text-gray-500 focus:ring-accent focus:outline-none focus:ring-2 focus:ring-inset sm:text-sm">
                        <option value="+33">FR +33</option>
                        <option value="+352">LU +352</option>
                        <option value="+32">BE +32</option>
                        <option value="+49">DE +49</option>
                        <option value="+34">ES +34</option>
                        <option value="+44">UK +44</option>
                    </select>
                </div>
                <x-text-input type="text" name="phone" id="phone" class="mt-1 block w-full pl-24"
                              placeholder="6 01 23 45 67"
                              :value="old('phone', substr($user->phone->formatNational(), 1)) "/>
            </div>
        </div>

        <div class="flex items-center gap-4 col-start-1">
            <x-primary-button class="mt-6">{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
