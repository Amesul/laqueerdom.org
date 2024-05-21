@php use Illuminate\Support\Facades\Auth; @endphp
<x-dashboard-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <x-glassmorphism class="p-8">
        Bienvenue {{ Auth::user()->name }}
    </x-glassmorphism>
</x-dashboard-layout>
