<x-dashboard-layout :breadcrumbs="[[null, 'Performances'],]">
    <x-slot:title>Performances</x-slot:title>

     <x-glassmorphism role="list" class="my-6">
        @if($performances->count())
            <div
                x-data="{
                currentTab: $persist('upcoming').using(sessionStorage),
                init() {
                    let border = document.querySelector('#border');
                    let tabSelector = document.querySelector(`#${this.currentTab}`);
                    border.style.width = `${tabSelector.clientWidth}px`;
                    border.style.left = `${tabSelector.offsetLeft}px`;},
                changeTab(name) {
                    this.currentTab = name;
                } }">
                <div class="relative flex items-start sm:pb-0 bg-secondary rounded-t-xl px-8 shadow-lg">
                    <!-- Dropdown menu on small screens -->
                    <div class="sm:hidden">
                        <label for="currentTabs" class="sr-only">Sélectionner un onglet</label>
                        <select id="currentTabs" name="currentTabs" @change="changeTab($show.target.value)"
                                class="block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-accent focus:ring-accent focus:outline-none sm:text-sm">
                            <option value="all" selected>Tous</option>
                            <option value="upcoming" selected>À venir</option>
                            <option value="passed">Passées</option>
                        </select>
                    </div>

                    <!-- Tabs at small breakpoint and up -->
                    <div class="hidden sm:block">
                        <div>
                            <nav class="relative -mb-px flex gap-x-8" aria-label="Tabs">
                        <span id="border"
                              class="absolute bottom-0 rounded-full transition-all duration-700 ease-in-out bg-accent h-[0.175rem]"></span>
                                <x-dashboard.tab identifier="all">Tous</x-dashboard.tab>
                                <x-dashboard.tab identifier="upcoming"
                                                 :badge="$performances->where('show.event.date', '>', now())->count()">À
                                    venir
                                </x-dashboard.tab>
                                <x-dashboard.tab identifier="passed">Passées</x-dashboard.tab>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- All -->
                <ul x-show="currentTab === 'all'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                    @foreach($performances->sortByDesc('show.event.date') as $performance)
                        <x-lists.performance-row :performance="$performance"/>
                    @endforeach
                </ul>
                <!-- Upcoming -->
                <ul x-show="currentTab === 'upcoming'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                    @foreach($performances->where('show.event.date', '>', now()) as $performance)
                        <x-lists.performance-row :performance="$performance"/>
                    @endforeach
                </ul>

                <!-- Passed -->
                <ul x-show="currentTab === 'passed'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                    @foreach($performances->sortByDesc('show.event.date')->where('show.event.date', '<', now()) as $performance)
                        <x-lists.performance-row :performance="$performance"/>
                    @endforeach
                </ul>
            </div>
        @else
            <div>
                <p class="font-bold p-8">
                    Tu n'as pas de performances enregistrées !
                </p>
            </div>
        @endif
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
