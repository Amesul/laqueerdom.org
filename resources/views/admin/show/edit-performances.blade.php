<x-dashboard-layout
    :breadcrumbs="[['/shows', 'Shows'], ['', $show->event->title], ['', 'Performances'],]">
    <x-slot:title>Modifier un show</x-slot:title>
    <div x-data="{ editMode: $persist(false) }">
        <div class="flex items-center justify-between w-fit gap-x-6 ml-auto">
            <span class="flex flex-grow flex-col text-white text-end">
                <span class="text-sm font-medium leading-6" id="availability-label">Mode édition</span>
                <span class="text-sm text-gray-500" id="availability-description">Réorganiser les performances par glisser-déposer.</span>
            </span>
            <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
            <button type="button" role="switch" aria-checked="false" aria-labelledby="availability-label"
                    @click="editMode = !editMode"
                    :class="editMode ? 'bg-accent-600' : 'bg-gray-200'"
                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                    aria-describedby="availability-description">
                <!-- Enabled: "", Not Enabled: "" -->
                <span aria-hidden="true" :class="editMode ? 'translate-x-5' : 'translate-x-0'"
                      class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
            </button>
        </div>

        <x-glassmorphism class="my-6 px-8">
            <!-- Edit mode -->
            <ul x-show="editMode" role="list" class="divide-y divide-primary/15" id="sortable">
                @foreach($performances as $performance)
                    <li draggable="true" class="flex items-center justify-between py-2 gap-x-6 transition-all"
                        data-id="{{ $performance->id }}">
                        <div
                            class="min-w-0 px-2 py-3 flex-1 {{ $performance->deleted_at ? 'bg-striped opacity-60 rounded-xl' : '' }}">
                            <div class="flex items-start gap-x-3">
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $performance->title }}</p>
                                @if($performance->advancement === 100)
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-100 text-xs font-medium text-green-700 px-1.5 py-0.5">Terminée</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md bg-yellow-100 text-xs font-medium text-yellow-800 px-1.5 py-0.5">En cours</span>
                                @endif
                            </div>
                            <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                <p class="truncate">{{ $performance->user->profile->pseudo ?? $performance->user->name }}</p>
                            </div>
                        </div>
                        <div class="flex gap-x-4">
                            @if($performance->deleted_at)
                                <form action="{{ route('admin.performances.restore', $performance) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="w-5 h-5 text-primary-600 hover:text-green-600/80 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                        </svg>
                                        <span class="sr-only">Annuler la suppression</span>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.performances.destroy', $performance) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="w-5 h-5 text-primary-600 hover:text-red-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                    <span class="sr-only">Supprimer la performance</span>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Visualize mode -->
            <ul x-show="!editMode" role="list" class="divide-y divide-primary/15" id="sortable">
                @foreach($performances->where('deleted_at', '=', null) as $performance)
                    <li class="flex items-center justify-between gap-x-6 py-5 transition-all">
                        <a href="{{ route('admin.show.show-performance', [$show, $performance]) }}">
                            <div class="min-w-0 w-full">
                                <div class="flex items-start gap-x-3">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $performance->title }}</p>
                                    @if($performance->advancement === 100)
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-100 text-xs font-medium text-green-700 px-1.5 py-0.5">Terminée</span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-md bg-yellow-100 text-xs font-medium text-yellow-800 px-1.5 py-0.5">En cours</span>
                                    @endif
                                </div>
                                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                    <p class="truncate">{{ $performance->user->profile->pseudo ?? $performance->user->name }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </x-glassmorphism>

        <div class="py-4 text-end"
             x-data="{ openModal: false, selectedUser: {id: null, name: null}, search: null, openList: false }">
            <x-secondary-button @click="openModal = true">Ajouter</x-secondary-button>
            <div x-show="openModal" class="absolute top-0 left-0 h-full w-full" x-trap.noscroll="openModal">
                <!-- Background -->
                <div class="absolute top-0 left-0 z-40 h-full w-full scale-125 bg-primary/80"></div>

                <!-- Modal -->
                <div @click.outside="openModal = false"
                     class="absolute top-1/2 left-1/2 z-50 w-full -translate-x-1/2 rounded-md px-8 py-6 text-start bg-secondary sm:w-96">
                    <x-input-label for="combobox" class="block text-sm font-medium leading-6 text-gray-900" required>
                        Artiste
                    </x-input-label>
                    <div class="relative mt-2">
                        <input id="combobox" type="text" :value="selectedUser.name" x-model="search"
                               @focusin="openList = true"
                               class="w-full rounded-md border-0 bg-white pr-12 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 py-1.5 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                               role="combobox" aria-controls="options" aria-expanded="false"/>
                        <button type="button" @click="openList = !openList"
                                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            id="options" role="listbox"
                            x-show="openList">
                            @foreach($users as $user)
                                @if($user->hasRole('artist'))
                                    <li :class="[selectedUser.id === {{ $user->id }} ? 'bg-accent-600 text-white' : 'hover:bg-accent-300', '{{ $user->profile->pseudo ?? $user->name }}'.includes(search) || search === null ? 'block' : 'hidden']"
                                        class="relative cursor-pointer select-none py-2.5 pr-9 pl-3 text-gray-900 transition-all"
                                        id="option-{{$loop->index}}" role="option" tabindex="-1" x-model="search"
                                        @click="selectedUser = {id: {{ $user->id }}, name: '{{ $user->profile->pseudo ?? $user->name  }}' }; openList = false">
                                        <div class="flex items-center">
                                            @if(isset($user->profile->profile_picture))
                                                <img src="{{ asset($user->profile->profile_picture) }}"
                                                     alt="Photo de profil"
                                                     class="h-6 w-6 flex-none rounded-full bg-primary-50 object-cover">
                                            @else
                                                <div
                                                    class="grid h-6 w-6 items-center truncate rounded-full text-center text-xs font-bold text-primary bg-primary-50">
                                                    {{ mb_substr($user->name, 0, 2) }}
                                                </div>
                                            @endif
                                            <span class="ml-3 truncate"
                                                  :class="selectedUser.id === {{ $user->id }} ? 'font-bold' : ''">{{ $user->profile->pseudo ?? $user->name }}</span>
                                        </div>

                                        <span x-show="selectedUser.id === {{ $user->id}}"
                                              class="absolute inset-y-0 right-0 flex items-center pr-4 text-secondary">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"/>
                                        </svg>
                                    </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('admin.performances.store') }}" method="post" class="mt-8">
                        @csrf
                        <input type="hidden" name="user_id" :value="selectedUser.id">
                        <input type="hidden" name="show_id" value="{{ $show->id }}">
                        <x-primary-button>Ajouter</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sortableList =
            document.getElementById("sortable");
        let draggedItem = null;

        sortableList.addEventListener(
            "dragstart",
            (e) => {
                draggedItem = e.target;
                setTimeout(() => {
                    e.target.style.visibility =
                        "hidden";
                }, 0);
            });

        sortableList.addEventListener(
            "dragend",
            (e) => {
                setTimeout(() => {
                    e.target.style.visibility = "visible";
                    updateOrder();
                    draggedItem = null;
                }, 0);
            });

        sortableList.addEventListener(
            "dragover",
            (e) => {
                e.preventDefault();
                const afterElement =
                    getDragAfterElement(
                        sortableList,
                        e.clientY);
                const currentElement =
                    document.querySelector(
                        ".dragging");
                if (afterElement == null) {
                    sortableList.appendChild(
                        draggedItem
                    );
                } else {
                    sortableList.insertBefore(
                        draggedItem,
                        afterElement
                    );
                }
            });

        const getDragAfterElement = (
            container, y
        ) => {
            const draggableElements = [
                ...container.querySelectorAll(
                    "li:not(.dragging)"
                ),];

            return draggableElements.reduce(
                (closest, child) => {
                    const box =
                        child.getBoundingClientRect();
                    const offset =
                        y - box.top - box.height / 2;
                    if (
                        offset < 0 &&
                        offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child,
                        };
                    } else {
                        return closest;
                    }
                },
                {
                    offset: Number.NEGATIVE_INFINITY,
                }
            ).element;
        };

        function updateOrder() {
            let performances = [];
            $("#sortable").children().each(function (index, element) {
                performances.push({
                    id: $(this).attr('data-id'),
                    order: index + 1
                });
            });

            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "{{ route('admin.shows.update-performances', $show)  }}",
                data: {
                    performances: performances,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response);
                },
                fail(relPath, message, score) {
                    console.log(relPath)
                    console.log(message)
                    console.log(score)
                }
            });
        }
    </script>
</x-dashboard-layout>
