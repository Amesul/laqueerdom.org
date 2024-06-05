<footer class="mt-24 grid grid-cols-2 border-t-2 py-12 border-primary">
    <section>
        <h3 class="text-5xl text-primary font-display">La Queerdom</h3>
        <p class="mt-1 text-lg font-black">Association loi 1908</p>
        <p class="mt-4 text-lg text-gray-500 hover:text-gray-600"><a
                href="mailto:contact@laqueerdom.org">contact@laqueerdom.org</a></p>
    </section>
    <section class="grid grid-cols-2">
        <article>
            <h4 class="text-xl font-black text-primary">Plan du site</h4>
            <ul>
                <x-footer-link href="/">Accueil</x-footer-link>
                <x-footer-link href="{{ route('agenda', 'current') }}">Agenda</x-footer-link>
                <x-footer-link href="{{ route('about') }}">À propos</x-footer-link>
                <ul class="border-l pl-3 border-primary">
                    <x-footer-link href="{{ route('about') }}">Association</x-footer-link>
                    <x-footer-link href="{{ route('about.team') }}">Équipe</x-footer-link>
                    <x-footer-link href="{{ route('about.artists') }}">Artistes</x-footer-link>
                </ul>
                <x-footer-link href="{{ route('contact') }}">Contact</x-footer-link>
            </ul>
        </article>
        <aside>
            <h4 class="text-xl font-black text-primary">Autres</h4>
            <ul>
                <x-footer-link href="{{ route('login', ['referer' => 'https://artist.laqueerdom.test/dashboard']) }}">
                    Espace artiste
                </x-footer-link>
                <x-footer-link href="{{ route('login', ['referer' => 'https://admin.laqueerdom.test/dashboard']) }}">
                    Espace administrateur·ice
                </x-footer-link>
                <x-footer-link href="https://instagram.com/laqueerdom" target="_blank">Instagram</x-footer-link>
                <x-footer-link href="{{ route('about.legal') }}">Mentions légales</x-footer-link>
            </ul>
        </aside>
    </section>
</footer>
