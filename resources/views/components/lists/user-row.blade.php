@php use App\Models\Role; @endphp
@props([
    'user'
])
<li class="flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4">
        @if(isset($user->profile->profile_picture))
            <img src="{{ asset($user->profile->profile_picture) }}" alt="Photo de profil"
                 class="h-12 w-12 flex-none rounded-full bg-gray-50 object-cover">
        @else
            <div
                class="grid h-12 w-12 px-2 items-center truncate rounded-full text-center text-xs font-bold text-primary bg-accent-200">
                {{ mb_substr($user->name, 0, 3) }}
            </div>
        @endif
        <div class="min-w-0 flex-auto">
            <p class="font-semibold leading-6 text-primary-900">{{ $user->name }}</p>
            <p class="mt-1 truncate text-xs leading-5 text-slate-500">{{ $user->username }}</p>
        </div>
    </div>
    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
        @isset($user->profile->job)
            <p class="text-sm leading-6 text-primary-900">{{  $user->profile->job }}</p>
        @endisset
        <div class="mt-1 inline-flex gap-x-2">
            @foreach($user->roles as $role)
                <span
                    class="inline-flex items-center gap-x-1 rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $role->slug === 'admin' ? 'bg-purple-50 text-purple-700 ring-purple-700/10' : ($role->slug === 'staff' ? 'bg-green-50 text-green-700 ring-green-600/20' : ($role->slug === 'volunteer' ? 'bg-blue-50 text-blue-700 ring-blue-600/20' : 'bg-accent-50 text-accent-800 ring-accent-600/25')) }}">
                    {{ $role->name }}
                    @if($role->slug !== 'admin')
                        <form action="{{ route('admin.users.update', $user) }}" method="post"
                              class="relative -mr-1 rounded-sm transition-all group h-3.5 w-3.5 hover:bg-slate-600/20">
                            @csrf @method('PUT')

                            <input type="hidden" name="remove_role" value="{{ $role->id }}">

                            <button type="submit">
                                <span class="sr-only">Retirer le rôle</span>
                                <svg viewBox="0 0 14 14"
                                     class="stroke-slate-600/50 transition-all h-3.5 w-3.5 group-hover:stroke-slate-600/75">
                                    <path d="M4 4l6 6m0-6l-6 6"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </span>
            @endforeach
            @if(array_intersect(['staff', 'artist', 'volunteer'], $user->roles()->pluck('slug')->toArray()) !== ['staff', 'artist', 'volunteer'])
                <div x-data="roles" class="">
                    <form id="update-{{ $user->username }}-roles" action="{{ route('admin.users.update', $user) }}"
                          method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="add_roles" :value="selection">
                    </form>
                    <x-dropdown>
                        <x-slot:trigger>
                            <button>
                                <span
                                    class="inline-flex items-center rounded-md bg-white px-3 py-1 text-xs font-medium text-slate-600 ring-1 ring-inset ring-slate-900/25 transition-all hover:bg-slate-100">
                                +
                                <span class="sr-only">Ajouter un rôle</span>
                                </span>
                            </button>
                        </x-slot:trigger>

                        <x-slot:content>
                            <ul class="px-3 divide-y divide-primary/10">
                                @foreach(Role::all() as $role)
                                    @if(!$user->hasRole($role->slug) && $role->slug !== 'admin')
                                        <li>
                                            <button type="button" @click.prevent="toggle('{{ $role->id }}')"
                                                    class="inline-flex w-full items-center justify-between py-1 text-start transition-all"
                                                    :class="selection.includes('{{ $role->id }}') ? 'font-bold text-primary' : 'text-slate-400 hover:text-primary'">
                                                <span>{{ $role->name }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="h-4 w-4"
                                                     :class="selection.includes('{{ $role->id }}') ? 'block' : 'hidden'">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m4.5 12.75 6 6 9-13.5"/>
                                                </svg>
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                                <button type="submit" form="update-{{ $user->username }}-roles"
                                        class="w-full py-1 text-start transition-all hover:text-green-600">Enregistrer
                                </button>
                            </ul>
                        </x-slot:content>
                    </x-dropdown>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('roles', () => ({
                selection: [],

                toggle(id) {
                    if (this.selection.includes(id)) {
                        const index = this.selection.indexOf(id)
                        this.selection.splice(index, 1)
                    } else {
                        this.selection.push(id)
                    }
                },
            }))
        })
    </script>
</li>
