<x-dashboard.nav-link href="{{ route('admin.dashboard') }}"
                      :active="request()->is('dashboard')">Dashboard
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.performances.index') }}" :active="request()->is('performances')">
    Performances
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.events.index') }}" :active="request()->is('events')">
    Événements
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.directory') }}" :active="request()->is('directory')">
    Annuaire
</x-dashboard.nav-link>
