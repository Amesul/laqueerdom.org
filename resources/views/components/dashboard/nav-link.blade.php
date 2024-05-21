@props(['active' => false])
<a {{ $attributes }} aria-current="{{$active ? 'page' : 'false'}}"
   class="rounded-md px-3 py-2 text-sm font-bold transition-all {{ $active ? 'bg-primary-500 text-secondary' : 'text-primary hover:bg-primary-100' }}">{{ $slot }}</a>
