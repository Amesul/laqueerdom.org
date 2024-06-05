<x-dashboard-layout
    :breadcrumbs="[['/venues', 'Partenaires'],[null, 'Créer'],]">
    <x-slot:title>Créer une structure</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <form action="{{ route('admin.venues.store') }}" method="post">
            @csrf
            <div class="grid gap-8 max-w-2xl md:grid-cols-2">

                <!-- Title -->
                <div class="col-span-full">
                    <x-input-label required required for="name" :value="__('Nom')"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-primary" required
                                  :value="old('name')"/>
                    <x-input-error :messages="$errors->get('name')"/>
                </div>

                <!-- Address -->
                <div class="col-span-full">
                    <x-input-label required for="address" :value="__('Adresse')"/>
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" required
                                  :value="old('address')" autofocus autocomplete="address-line1"/>
                    <x-input-error :messages="$errors->get('address')"/>
                </div>

                <!-- Address Line 2 -->
                <div class="col-span-full">
                    <x-input-label for="address2" :value="__('Adresse ligne 2 (optionnel)')"/>
                    <x-text-input id="address2" name="address2" type="text" class="mt-1 block w-full" autofocus
                                  :value="old('address2')" autocomplete="address-line2"/>
                    <x-input-error :messages="$errors->get('address2')"/>
                </div>

                <!-- Zip Code -->
                <div class="col-span-1">
                    <x-input-label required for="zip_code" :value="__('Code postal')"/>
                    <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" required autofocus
                                  :value="old('zip_code')" autocomplete="postal-code"/>
                    <x-input-error :messages="$errors->get('zip_code')"/>
                </div>

                <!-- City -->
                <div class="col-span-1">
                    <x-input-label required for="city" :value="__('Ville')"/>
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" required autofocus
                                  :value="old('city')" autocomplete="city"/>
                    <x-input-error :messages="$errors->get('city')"/>
                </div>

                <!-- Country -->
                <div class="col-span-full">
                    <x-input-label required for="country" :value="__('Pays')"/>
                    <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" required autofocus
                                  :value="old('country')" autocomplete="country-name"/>
                    <x-input-error :messages="$errors->get('country')"/>
                </div>

            </div>
            <div class="mt-12 flex gap-4">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Créer</x-primary-button>
            </div>
        </form>
    </x-glassmorphism>
</x-dashboard-layout>
