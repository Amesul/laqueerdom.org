@if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin') || \Illuminate\Support\Facades\Auth::user()->hasRole('staff'))
    <x-dashboard.nav-link href="{{ route('admin.dashboard') }}">Espace administrateur</x-dashboard.nav-link>
@endif
@if(\Illuminate\Support\Facades\Auth::user()->hasRole('artist'))
    <x-dashboard.nav-link href="{{ route('artist.dashboard') }}">Espace artiste</x-dashboard.nav-link>
@endif
