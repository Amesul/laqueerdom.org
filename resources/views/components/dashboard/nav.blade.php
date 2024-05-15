<x-dashboard.nav-link href="{{ route('admin.dashboard') }}"
                      :active="request()->is('dashboard')">Dashboard
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.events.index') }}" :active="request()->is('')">
    Événements
</x-dashboard.nav-link>
<x-dashboard.nav-link href="#" :active="request()->is('#')">Shows</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.venues.index') }}" :active="request()->is('#')">
    Partenaires
</x-dashboard.nav-link>
<x-dashboard.nav-link href="#" :active="request()->is('#')">Documents</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.users.index') }}" :active="request()->is('#')">
    Utilisateurs
</x-dashboard.nav-link>
