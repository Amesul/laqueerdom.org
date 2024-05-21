@props([
    'tilte' => null,
    'breadcrumbs' => null,
    'quickAction' => null
])
    <!DOCTYPE html>
<html lang="fr" class="h-screen bg-mesh">

<x-utils.head :title="$title"/>

<body class="overflow-y-scroll overflow-x-hidden h-full">

@if (Session::has('info'))
    <x-flash type="info">{{ Session::get('info') }}</x-flash>
@elseif(Session::has('danger'))
    <x-flash type="danger">{{ Session::get('danger') }}</x-flash>
@elseif(Session::has('success'))
    <x-flash type="success">{{ Session::get('success') }}</x-flash>
@endif

<div class="min-h-full">
    @include('layouts.auth.navigation', ['quickAction' => $quickAction])
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @isset($breadcrumbs)
                <header class="hidden md:block">
                    <x-dashboard.breadcrumbs :breadcrumbs="$breadcrumbs"/>
                </header>
            @endisset
            {{ $slot }}
        </div>
    </main>
</div>

</body>
</html>
