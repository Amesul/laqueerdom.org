@props(['submenu' => false, 'id'])
<li class="px-8 group">
    <a class="relative z-40 opacity-80 transition-all group-hover:opacity-100" {{ $attributes }}>{{ $slot }}</a>

    @if($submenu)
        <div class="absolute top-0 left-0 h-0 w-full opacity-100 transition-all overflow-hidden duration-500 group-hover:h-24 ease-in-out">
            <div
                class="absolute top-12 left-0 z-40 flex h-12 w-full bg-white bg-opacity-80 opacity-0 backdrop-blur-lg transition-all duration-700 group-hover:opacity-100">
                {{ $submenu }}
            </div>

        </div>
        <div
            class="pointer-events-none absolute top-12 left-0 -z-0 h-screen w-screen opacity-0 backdrop-blur-lg backdrop-brightness-75 transition-all duration-500 group-hover:opacity-100"></div>
    @endif
</li>
