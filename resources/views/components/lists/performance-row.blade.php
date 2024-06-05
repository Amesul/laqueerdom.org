@props([
    /** @var \mixed */
    'performance'
])

<li class="flex items-center justify-between gap-x-6 py-5">
    <div class="w-full flex-1">
        <div class="flex items-start gap-x-3">
            <a href="{{ route('artist.performances.edit', [$performance]) }}"><p
                    class="text-sm font-semibold leading-6 text-gray-900 hover:underline" title="Modifier la performance">{{ $performance->title }}</p></a>
            @if($performance->advancement === 100)
                <span
                    class="inline-flex items-center rounded-md bg-green-100 text-xs font-medium text-green-700 px-1.5 py-0.5">Terminée</span>
            @else
                <span
                    class="inline-flex items-center rounded-md bg-yellow-100 text-xs font-medium text-yellow-800 px-1.5 py-0.5">En cours</span>
            @endif
        </div>
        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
            <p class="truncate">
                {{ ucfirst($performance->show->event->date->translatedFormat('D j M Y, H:i')) }}
                , {{ $performance->show->event->venue->name }} - {{  $performance->show->event->venue->city }}</p>
        </div>
    </div>
    @if($performance->show->event->date > now())
        <div class="group">
            <p class="text-sm text-end text-primary font-bold">Deadline</p>
            <p class="text-sm text-end text-slate-700 relative">
                <time
                    datetime="{{ $performance->show->deadline->format('Y/m/d') }}">
                                        <span
                                            class="group-hover:opacity-0 transition-all">{{ $performance->show->deadline->diffForHumans() }}</span>
                    <span
                        class="absolute left-0 top-0 w-full group-hover:opacity-100 opacity-0 transition-all">{{ $performance->show->deadline->translatedFormat('d/m/Y') }}</span>
                </time>
            </p>
        </div>
    @endif
</li>
