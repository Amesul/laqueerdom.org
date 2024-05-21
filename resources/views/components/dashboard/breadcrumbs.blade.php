<nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex space-x-4">
        <li class="flex">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-slate-200">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Dashboard</span>
                </a>
            </div>
        </li>
        @foreach($breadcrumbs as [$link, $name])
            <li class="flex">
                <div class="flex items-center">
                    <p class="h-full w-6 flex-shrink-0 text-slate-400"> / </p>
                    @if($link)
                        <a href="{{ $link }}"
                           class="text-sm font-medium text-slate-400 hover:text-slate-200 transition-all">{{ $name }}</a>
                    @else
                        <p class="text-sm font-medium text-slate-400">{{ $name }}</p>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
