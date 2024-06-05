<x-dashboard-layout
    :breadcrumbs="[['/shows', 'Shows'],['', $show->event->title],['', 'Modifier'],]">
    <x-slot:title>Modifier</x-slot:title>

    <x-glassmorphism class="my-6 p-8">
        <form action="{{ route('admin.shows.update', $show) }}" method="post"
              class="max-w-xl">
            @csrf @method('PATCH')

            <!-- Deadline -->
            <div class="">
                <x-input-label required for="deadline" :value="__('Deadline')"/>
                <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full"
                              :value="old('deadline', $show->deadline->format('Y-m-d'))" required autofocus/>
                <x-input-error :messages="$errors->get('deadline')"/>
            </div>
            <div class="mt-6">
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    </x-glassmorphism>

    <x-glassmorphism class="my-6 p-8">
        <div x-data="{openApplicationsModal: false}">
            <h2 class="font-bold">Candidatures</h2>
            <button role="button" @click.prevent="openApplicationsModal = true"
                    class="inline-flex mt-1 items-center px-4 py-2 bg-accent-400 border border-transparent rounded-md font-semibold text-xs text-secondary uppercase tracking-widest hover:bg-accent-600 focus:bg-accent-600 active:bg-accent-800 focus:outline-none focus:ring-2 focus:ring-accent-600 focus:ring-offset-2 transition ease-in-out duration-150">{{ $show->applications_open ? 'Fermer' : 'Ouvrir'}}</button>
            <div x-show="openApplicationsModal" x-trap.noscroll="openApplicationsModal">
                <div class="absolute z-40 scale-150 h-screen w-screen bg-primary/80 -top-1/2 left-0"></div>
                <form action="{{ route('admin.shows.toggle-applications', $show) }}" method="post">
                    @csrf @method('PATCH')
                    <div
                        class="z-50 w-full sm:w-96 absolute top-1/2 left-1/2 bg-secondary origin-center -translate-x-1/2 rounded-md px-12 py-6">
                        <p>Es-tu sûr·e de vouloir {{ $show->applications_open ? 'fermer' : 'ouvrir'}} les candidatures
                            ?</p>
                        <div class="mr-auto w-fit h-fit">
                            <x-primary-button class="mt-4 ml-auto">Confirmer</x-primary-button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </x-glassmorphism>
</x-dashboard-layout>
