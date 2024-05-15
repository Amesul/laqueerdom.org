@props(['active' => false])
<a {{ $attributes }} aria-current="{{$active ? 'page' : 'false'}}"
   class="rounded-md px-3 py-2 text-sm font-bold transition-all {{ $active ? 'bg-accent-700 text-primary' : 'text-primary-300 hover:bg-accent-900 hover:bg-opacity-75' }}">{{ $slot }}</a>
