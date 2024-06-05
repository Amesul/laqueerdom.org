<x-dashboard-layout :breadcrumbs="[[null, 'Shows'],]">
    <x-slot:title>Shows</x-slot:title>

    <x-glassmorphism role="list" class="my-6">
        <div
            x-data="{
                currentTabs: {show: $persist('upcoming').using(sessionStorage)},
                init() {
                    let border = document.querySelector('#border');
                    let tabSelector = document.querySelector(`#${this.currentTabs.show}`);
                    border.style.width = `${tabSelector.clientWidth}px`;
                    border.style.left = `${tabSelector.offsetLeft}px`;},
                changeTab(name) {
                    this.currentTabs.show = name;
                } }">
            <div class="relative flex items-start sm:pb-0 bg-secondary rounded-t-xl px-8 shadow-lg">
                <!-- Dropdown menu on small screens -->
                <div class="sm:hidden">
                    <label for="currentTabs.shows" class="sr-only">Sélectionner un onglet</label>
                    <select id="currentTabs.shows" name="currentTabs.shows" @change="changeTab($show.target.value)"
                            class="block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-accent focus:ring-accent focus:outline-none sm:text-sm">
                        <option value="upcoming" selected>À venir</option>
                        <option value="open" selected>Ouverts</option>
                        <option value="archived">Archivés</option>
                    </select>
                </div>

                <!-- Tabs at small breakpoint and up -->
                <div class="hidden sm:block">
                    <div>
                        <nav class="relative -mb-px flex gap-x-8" aria-label="Tabs">
                        <span id="border"
                              class="absolute bottom-0 rounded-full transition-all duration-700 ease-in-out bg-accent h-[0.175rem]"></span>
                            <x-dashboard.tab context="show" identifier="upcoming"
                                             :badge="$shows->where('event.date', '>', now())->count()">À venir
                            </x-dashboard.tab>
                            <x-dashboard.tab context="show" identifier="open"
                                             :badge="$shows->where('applications_open', '=', true)->count()">Ouverts
                            </x-dashboard.tab>
                            <x-dashboard.tab context="show" identifier="archived">Archivés
                            </x-dashboard.tab>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Upcoming -->
            <ul x-show="currentTabs.show === 'upcoming'" role="list"
                class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @forelse($shows->where('event.date', '>', now()) as $show)
                    <x-lists.show-row :show="$show"/>
                @empty
                    <div class="py-5"></div>
                @endforelse
            </ul>
            <!-- All -->
            <ul x-show="currentTabs.show === 'open'" role="list"
                class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @forelse($shows->where('applications_open', '=', true) as $show)
                    <x-lists.show-row :show="$show"/>
                @empty
                    <div class="py-5"></div>
                @endforelse
            </ul>
            <!-- Passed -->
            <ul x-show="currentTabs.show === 'archived'" role="list"
                class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @forelse($shows->where('event.date', '<', now()) as $show)
                    <x-lists.show-row :show="$show"/>
                @empty
                    <div class="py-5"></div>
                @endforelse
            </ul>
        </div>
    </x-glassmorphism>
    <script>
        function moveBorder(name) {
            let border = document.querySelector('#border');
            let tabSelector = document.querySelector(`#${name}`);
            border.style.width = `${tabSelector.clientWidth}px`;
            border.style.left = `${tabSelector.offsetLeft}px`;
        }
    </script>
</x-dashboard-layout>
