@php $user = Illuminate\Support\Facades\Auth::user() @endphp
@props([
    'tilte' => null,
    'breadcrumbs' => null,
])
    <!DOCTYPE html>
<html lang="fr" class="h-full bg-primary">

<x-utils.head :title="$title"/>

<body class="h-full">

<div class="min-h-full">
    <nav class="bg-secondary" x-data="{openMobileMenu: false}">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=pink&shade=400"
                             alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Links -->
                            <x-dashboard.nav/>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button type="button"
                                class="relative rounded-full p-1 transition-all bg-secondary text-primary-300 hover:text-primary focus:ring-primary focus:ring-offset-secondary focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Voir les notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3" x-data="{openUserMenu: false}">
                            <div>
                                <button type="button" @click="openUserMenu = !openUserMenu"
                                        class="relative flex max-w-xs items-center rounded-full text-sm bg-secondary focus:ring-primary focus:ring-offset-secondary focus:outline-none focus:ring-2 focus:ring-offset-2"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Ouvrir le menu utilisateur</span>
                                    <img class="h-8 w-8 rounded-full"
                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                         alt="Photo de profil">
                                </button>
                            </div>

                            <div x-show="openUserMenu" @click.outside="openUserMenu = false" tabindex="-1"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                 class="absolute right-0 z-10 mt-2 w-48 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="{{ route('profile.edit', 'user') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 transition-all hover:bg-gray-50"
                                   role="menuitem" tabindex="-1"
                                   id="user-menu-item-0">Compte</a>
                                <a href="{{ route('profile.edit', 'profile') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 transition-all hover:bg-gray-50"
                                   role="menuitem" tabindex="-1"
                                   id="user-menu-item-1">Profil</a>
                                <a href="{{ route('profile.edit', 'privacy') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 transition-all hover:bg-gray-50"
                                   role="menuitem" tabindex="-1"
                                   id="user-menu-item-2">Confidentialité</a>
                                <a href="{{ route('profile.edit', 'security') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 transition-all hover:bg-gray-50"
                                   role="menuitem" tabindex="-1"
                                   id="user-menu-item-3">Sécurité</a>
                                <form action="{{ route('logout') }}" method="post"
                                      class="block px-4 py-2 text-sm text-red-500 transition-all hover:bg-red-50">
                                    <button role="menuitem" tabindex="-1"
                                            id="user-menu-item-4">Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" @click="openMobileMenu = !openMobileMenu"
                            class="relative inline-flex items-center justify-center rounded-md bg-secondary p-2 hover:text-primary text-primary-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-secondary"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Ouvrir le menu principal</span>

                        <svg x-show="!openMobileMenu" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>

                        <svg x-show="openMobileMenu" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="openMobileMenu" @click.outside="openMobileMenu = false" class="md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 flex-col flex">
                <!-- Links -->
                <x-dashboard.nav/>
            </div>
            <div class="border-t border-accent pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-primary">{{ $user->name }}</div>
                        <div class="text-sm font-medium text-accent-300">{{ $user->email }}</div>
                    </div>
                    <button type="button"
                            class="relative ml-auto flex-shrink-0 rounded-full bg-secondary p-1 text-primary-100 hover:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-secondary">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Voir les notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-3 px-2 space-y-1 flex-col flex">
                    <x-dashboard.nav-link>Compte</x-dashboard.nav-link>
                    <x-dashboard.nav-link>Profil</x-dashboard.nav-link>
                    <x-dashboard.nav-link>Confidentialité</x-dashboard.nav-link>
                    <x-dashboard.nav-link>Sécurité</x-dashboard.nav-link>
                    <form action="{{ route('logout') }}" method="post"
                          class="rounded-md px-3 py-2 text-sm font-bold transition-all text-red-400 hover:bg-red-300 hover:bg-opacity-75">
                        @csrf
                        <button>Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @isset($breadcrumbs)
        <header class="hidden md:block">
            <x-dashboard.breadcrumbs :breadcrumbs="$breadcrumbs"/>
        </header>
    @endisset
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <!-- Your content -->
        </div>
    </main>
</div>

</body>
</html>
