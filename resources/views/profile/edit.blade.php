@php use Illuminate\Support\Facades\Auth;$user = Auth::user(); $partial = $_REQUEST['partial'] ?? 'user'; @endphp

<x-dashboard-layout>
    <x-slot:title>Réglages</x-slot:title>
    <div class="max-w-7xl mx-auto space-y-6">
        @if($partial === 'user')
            <x-glassmorphism class="my-6 p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-user-information-form')
                </div>
            </x-glassmorphism>
        @elseif($partial === 'security')
            <x-glassmorphism class="my-6 p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </x-glassmorphism>

            <x-glassmorphism class="my-6 p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </x-glassmorphism>
        @elseif($partial === 'profile')
            <x-glassmorphism class="my-6 p-8">
                @include('profile.partials.update-profile-information-form')
            </x-glassmorphism>
        @elseif($partial === 'privacy')
            <x-glassmorphism class="my-6 p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-user-privacy-form')
                </div>
            </x-glassmorphism>
        @endif
    </div>
</x-dashboard-layout>
