@props([
    'identifier',
    'badge' => null
])
<button {{ $attributes }} id="{{ $identifier }}" :aria-current="tab === '{{ $identifier }}' ? 'page' : 'false'"
        class="flex whitespace-nowrap py-4 px-1 text-sm font-medium transition-all"
        :class="tab === '{{ $identifier }}' ? 'text-accent' : 'text-gray-500 hover:border-gray-200 hover:text-gray-700' ">
    {{ $slot }}
    @isset($badge)
        <span class="ml-3 rounded-full py-0.5 px-2.5 text-xs font-medium inline-block transition-all"
              :class="tab === '{{ $identifier }}' ? 'bg-accent bg-opacity-15 text-accent' : 'bg-slate-200 text-gray-900'">{{ $badge }}</span>
    @endif
</button>
