@php $user = Illuminate\Support\Facades\Auth::user(); @endphp
<x-dashboard-layout :breadcrumbs="[['/documents', 'Documents'], ['/documents/' . $document->slug, $document->title]]">
    <x-slot:title>{{ $document->title }}</x-slot:title>

    @can('update', $document)
        <x-slot:quickAction>
            <x-dashboard.quick-action :link="route('admin.documents.edit', $document)">Modifier
            </x-dashboard.quick-action>
        </x-slot:quickAction>
    @endcan

    <div class="flex flex-col md:flex-row gap-4">
        <!-- Document content -->
        <x-glassmorphism class="p-8 w-2/3">
            <section class="formatted-input">
                {!! $document->content !!}
            </section>
        </x-glassmorphism>

        <!-- Comments section -->
        <aside class="space-y-6 w-1/3">
            <x-glassmorphism class="overflow-hidden px-4 py-2 w-full h-fit">
                <form action="{{ route('admin.comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="document_id" value="{{ $document->id }}">

                    <!-- Message -->
                    <div>
                        <x-input-label for="message" class="sr-only" :value="__('Ajouter un commentaire')"/>
                        <textarea rows="5" maxlength="500" name="message" id="message"
                                  class="w-full outline-none focus:ring-0 focus:border-0 focus:border-b-2 focus:border-primary-500 resize-none border-b-2 border-0 border-primary/30 bg-transparent"></textarea>
                        <x-input-error :messages="$errors->get('message')"/>
                    </div>

                    <div class="text-end mt-2">
                        <x-primary-button>Envoyer</x-primary-button>
                    </div>
                </form>
            </x-glassmorphism>
            <div class=" sticky top-8">
                @foreach($comments->sortBy('created_at') as $comment)
                    <x-glassmorphism class="p-4 w-full space-y-2 relative">
                        @can('delete', $comment)
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="post"
                                  class='text-slate-400 hover:text-accent right-4 absolute transition-all'>
                                @csrf @method('DELETE')
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>

                                </button>
                            </form>
                        @endcan
                        <header class="flex items-center w-full gap-2">
                            @if(isset($comment->user->profile->profile_picture))
                                <img class="h-12 w-12 rounded-full bg-gray-50 object-cover"
                                     src="{{ asset($comment->user->profile->profile_picture) }}"
                                     alt="Photo de profil de {{ $comment->user->username }}">
                            @else
                                <div
                                    class="h-12 w-12 rounded-full bg-gray-50 ring-2 text-primary">
                                    {{ mb_substr($comment->user->name, 0, 3) }}
                                </div>
                            @endif
                            <div>
                                <h1 class="text-primary font-bold">{{ $comment->user->name }}</h1>
                                <p class="text-slate-600 text-xs">{{ '@' . $comment->user->username }}</p>
                            </div>
                        </header>
                        <main>{{ $comment->message }}</main>
                    </x-glassmorphism>
                @endforeach
            </div>
        </aside>
    </div>
</x-dashboard-layout>
