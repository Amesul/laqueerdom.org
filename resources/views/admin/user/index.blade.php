<x-dashboard-layout :breadcrumbs="[[null, 'Utilisateur·ices'],]">
    <x-slot:title>Utilisateur·ices</x-slot:title>

    <x-glassmorphism class="my-6 px-8">
        <ul role="list" class="divide-y divide-slate-900/15">
            @foreach($users as $user)
                <x-lists.user-row :user="$user"/>
            @endforeach
        </ul>
    </x-glassmorphism>
</x-dashboard-layout>
