<x-dashboard.nav-link href="{{ route('admin.dashboard') }}" :active="request()->is('dashboard')">
    Dashboard
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.events.index') }}" :active="request()->is('events*')">
    Événements
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.shows.index') }}" :active="request()->is('shows*')">
    Shows
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.venues.index') }}" :active="request()->is('venues*')">
    Partenaires
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.documents.index') }}" :active="request()->is('documents*')">
    Documents
</x-dashboard.nav-link>
<x-dashboard.nav-link href="{{ route('admin.users.index') }}" :active="request()->is('users*')">
    Utilisateurs
</x-dashboard.nav-link>
