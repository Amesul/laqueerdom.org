<x-dashboard.nav-link href="{{ route('artist.dashboard') }}"
                      :active="request()->is('dashboard')">Dashboard
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.performances.index') }}" :active="request()->is('performances')">
    Performances
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.applications.index') }}" :active="request()->is('applications')">
    Candidatures
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.booking.index') }}" :active="request()->is('booking')">
    Booking
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('artist.directory') }}" :active="request()->is('directory')">
    Annuaire
</x-dashboard.nav-link>
