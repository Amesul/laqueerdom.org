@props(['link'])
<div class="flex-shrink-0 ml-auto">
    <a href="{{ $link }}" type="button"
       class="relative inline-flex items-center gap-x-1.5 rounded-md bg-accent px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent-600">
        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path
                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
        </svg>

        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            Créer
        @endif
    </a>
</div>
