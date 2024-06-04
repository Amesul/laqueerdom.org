<x-dashboard-layout :breadcrumbs="[['/events', 'Événements'],]">
    <x-slot:title>Évènements</x-slot:title>
    <x-slot:quickAction>
        <x-dashboard.quick-action :link="route('admin.events.create')"/>
    </x-slot:quickAction>

    <x-glassmorphism role="list">
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
                    <select id="currentTabs" name="currentTabs" @change="changeTab($event.target.value)"
                            class="block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-accent focus:ring-accent focus:outline-none sm:text-sm">
                        <option value="all">Tous</option>
                        <option value="upcoming" selected>À venir</option>
                        <option value="passed">Passé</option>
                        <option value="drafts">Non publiés</option>
                    </select>
                </div>

                <!-- Tabs at small breakpoint and up -->
                <div class="hidden sm:block">
                    <div>
                        <nav class="relative -mb-px flex gap-x-8" aria-label="Tabs">
                        <span id="border"
                              class="absolute bottom-0 rounded-full transition-all duration-700 ease-in-out bg-accent h-[0.175rem]"></span>
                            <x-dashboard.tab identifier="all">Tous
                            </x-dashboard.tab>
                            <x-dashboard.tab identifier="upcoming"
                                             :badge="$events->where('date', '>', now())->count()">À venir
                            </x-dashboard.tab>
                            <x-dashboard.tab identifier="passed">
                                Passés
                            </x-dashboard.tab>
                            <x-dashboard.tab identifier="drafts"
                                             :badge="$events->where('published', '==', false)->count()">Brouillons
                            </x-dashboard.tab>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- All -->
            <ul x-show="currentTab === 'all'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @foreach($events as $event)
                    <x-lists.event-row :event="$event"/>
                @endforeach
            </ul>
            <!-- Upcoming -->
            <ul x-show="currentTab === 'upcoming'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @foreach($events->where('date', '>', now()) as $event)
                    <x-lists.event-row :event="$event"/>
                @endforeach
            </ul>
            <!-- Passed -->
            <ul x-show="currentTab === 'passed'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @foreach($events->where('date', '<', now()) as $event)
                    <x-lists.event-row :event="$event"/>
                @endforeach
            </ul>
            <!-- Drafts -->
            <ul x-show="currentTab === 'drafts'" role="list" class="rounded-md divide-y divide-primary/10 px-8 py-2">
                @foreach($events->where('published', '==', false) as $event)
                    <x-lists.event-row :event="$event"/>
                @endforeach
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
