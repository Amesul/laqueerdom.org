@php use Illuminate\Support\Facades\Auth; @endphp
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff'))
    <x-dashboard.nav-link href="{{ route('admin.dashboard') }}">Espace administrateur</x-dashboard.nav-link>
@endif
@if(Auth::user()->hasRole('artist'))
    <x-dashboard.nav-link href="{{ route('artist.dashboard') }}">Espace artiste</x-dashboard.nav-link>
@endif
