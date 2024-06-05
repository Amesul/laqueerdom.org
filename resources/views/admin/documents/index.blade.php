@php $users = []; @endphp

<x-dashboard-layout :breadcrumbs="[['','Documents'],]">
    <x-slot:title>Documents</x-slot:title>

    <x-slot:quickAction>
        <x-dashboard.quick-action :link="route('admin.documents.create')"/>
    </x-slot:quickAction>

    <x-glassmorphism class="my-6 px-8">
        <ul role="list" class="divide-y divide-slate-800/25">
            @foreach($documents as $document)
                <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap">
                    <div>
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            <a href="{{ route('admin.documents.show', $document) }}"
                               class="hover:underline">{{ $document->title }}</a>
                        </p>
                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p>{{ $document->user->name }}
                            </p>
                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                <circle cx="1" cy="1" r="1"/>
                            </svg>
                            <p>
                                <time
                                    datetime="{{ $document->created_at->format('Y-m-dTH:iZ') }}">{{ $document->created_at->diffForHumans() }}</time>
                            </p>
                        </div>
                    </div>
                    <dl class="flex w-full flex-none justify-between gap-x-8 sm:w-auto items-center">
                        <div class="flex -space-x-0.5">
                            <dt class="sr-only">Commentaires</dt>
                            @foreach($document->comments as $comment)
                                @if(!in_array($comment->user->username, $users))
                                    @php $users[] = $comment->user->username; @endphp
                                    <dd>
                                        @if(isset($comment->user->profile->profile_picture))
                                            <img class="h-7 w-7 rounded-full bg-gray-50 ring-2 ring-white object-cover"
                                                 src="{{ asset($comment->user->profile->profile_picture) }}"
                                                 alt="Photo de profil de {{ $comment->user->username }}">
                                        @else
                                            <div
                                                class="h-7 w-7 rounded-full bg-slate-700 ring-2 text-xs grid place-content-center ring-white text-secondary">
                                                {{ mb_substr($comment->user->name, 0, 2) }}
                                            </div>
                                        @endif
                                    </dd>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex w-16 gap-x-2.5 items-center">
                            <dt>
                                <span class="sr-only">Nombre de commentaires</span>
                                <svg class="h-6 w-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                                </svg>
                            </dt>
                            <dd class="text-sm leading-6 text-gray-900">{{ $document->comments->count() }}</dd>
                        </div>
                    </dl>
                </li>
            @endforeach
        </ul>
    </x-glassmorphism>
</x-dashboard-layout>
