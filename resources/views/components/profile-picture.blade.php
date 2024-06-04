@props([
    'user',
])

@if(isset($user->profile->profile_picture))
    <img {{ $attributes->class('flex-none rounded-full bg-gray-50 object-cover') }}
         src="{{ asset($user->profile->profile_picture) }}" alt="Photo de profil">
@else
    <div {{ $attributes->class('grid px-2 items-center truncate rounded-full text-center text-xs font-bold text-accent bg-slate-100') }}>
        {{ mb_substr($user->name, 0, 3) }}
    </div>
@endif
