<nav class="fixed z-50 flex w-full justify-between px-12 py-3 text-white bg-primary">
    <div class="">Logo</div>
    <ul class="flex justify-around">
        <x-nav.link id="home" href="/">Accueil</x-nav.link>
        <x-nav.link id="agenda" href="{{ route('agenda') }}">Agenda
            <x-slot:submenu>
                <x-nav.submenu>
                    <x-nav.submenu-link href="{{ route('agenda', 'current') }}">Saison 23/24</x-nav.submenu-link>
                    <x-nav.submenu-link href="{{ route('agenda', 'archive') }}">Saisons précédentes</x-nav.submenu-link>
                </x-nav.submenu>
            </x-slot:submenu>
        </x-nav.link>
        <x-nav.link id="about" href="{{ route('about') }}">À propos
            <x-slot:submenu>
                <x-nav.submenu>
                    <x-nav.submenu-link href="{{ route('about') }}">Association</x-nav.submenu-link>
                    <x-nav.submenu-link href="{{ route('about.team') }}">L'équipe</x-nav.submenu-link>
                    <x-nav.submenu-link href="{{ route('about.artists') }}">Artistes</x-nav.submenu-link>
                </x-nav.submenu>
            </x-slot:submenu>
        </x-nav.link>
        <x-nav.link id="contact" href="{{ route('contact') }}">Contact</x-nav.link>
    </ul>

    <div class="">
        {{--        <form action="/search" method="get">--}}
        {{--            <input type="text" name="search-field" id="search-field" placeholder="Rechercher..." class="rounded-lg">--}}
        {{--            <button type="submit" class="hidden"></button>--}}
        {{--        </form>--}}
    </div>
</nav>
