<x-app-layout>
    <header class="px-12 py-24">
        <div class="relative z-10 my-auto py-8">
            <h2 class="text-8xl font-bold text-white font-display">Lorem ipsum dolor sit conquabitur.</h2>
        </div>
        <div class="mt-12 flex w-fit gap-6">
            <a href="#" target="_blank"
               class="rounded-lg px-6 py-3 text-2xl font-black text-white transition-all bg-primary-500 hover:bg-primary-400">Nous
                rejoindre</a>
            <a href="{{ route('agenda', 'current') }}"
               class="rounded-lg bg-white px-8 py-3 text-2xl font-black ring-2 ring-inset transition-all text-accent ring-accent hover:bg-accent-50">Nos
                événements</a>
        </div>
        <img id="cover" src="{{ Vite::asset('resources/images/_1040800.jpg') }}" alt="Dragshow aux Frigos"
             class="absolute top-12 right-6 -z-10 w-full bg-cover object-cover object-top shadow-xl h-full xl:right-0 brightness-75">

        <script>
            let cover = document.querySelector("#cover")
            onscroll = (event) => {
                cover.style.transform = `translateY(${scrollY * 3.8 / 100}%)`;
            };
        </script>
    </header>

    <main
        class="mx-40 mt-80 rounded-xl bg-white bg-opacity-20 px-12 py-6 text-xl shadow-xl saturate-150 bg-sky-100/50 backdrop-blur-2xl backdrop-brightness-[3.5] backdrop-contrast-50">
        <h3 class="text-center text-6xl font-black text-primary">Nos actions</h3>
        <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et eros vel sem tincidunt
            sodales.
            Curabitur rhoncus erat sed arcu ultricies mattis. Aenean ut dui facilisis orci tincidunt eleifend ut eget
            dolor. Ut velit massa, scelerisque nec venenatis at, consequat id purus. Phasellus ultrices semper nulla
            quis accumsan. Maecenas a libero sit amet risus sollicitudin auctor. Maecenas dictum nunc sed libero
            consequat eleifend.</p>
        <p class="mt-4">Donec consectetur nisl nec enim blandit facilisis. Duis semper orci arcu, a sodales enim
            placerat nec. Donec
            viverra condimentum diam, vitae ornare tellus pellentesque nec. Mauris sed pulvinar sem, et pulvinar turpis.
            Duis vel lacinia urna. Proin auctor, nisl at vulputate consequat, augue urna maximus libero, vel auctor
            libero massa sit amet libero. Nam id iaculis sem. Curabitur commodo lobortis congue. Nam feugiat erat
            tellus, at ultricies nisi laoreet at. Nullam nibh nisi, dapibus a pulvinar vitae, ultricies vel lectus. Ut
            eu nisl rutrum, pharetra mi vitae, finibus metus. Nulla vulputate venenatis dictum.</p>
    </main>

    <section class="mt-24 grid grid-cols-5 gap-4 py-12">
        <div class="col-span-3 h-96 rounded-xl border border-black bg-white shadow-xl">
            <svg class="h-full w-full text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none"
                 viewBox="0 0 200 200" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0"/>
            </svg>
        </div>
        <div class="col-span-2 h-96 rounded-xl border border-black bg-white shadow-xl">
            <svg class="h-full w-full text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none"
                 viewBox="0 0 200 200" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0"/>
            </svg>
        </div>
        <div class="col-span-2 h-96 rounded-xl border border-black bg-white shadow-xl">
            <svg class="h-full w-full text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none"
                 viewBox="0 0 200 200" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0"/>
            </svg>
        </div>
        <div class="col-span-3 h-96 rounded-xl border border-black bg-white shadow-xl">
            <svg class="h-full w-full text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none"
                 viewBox="0 0 200 200" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0"/>
            </svg>
        </div>
    </section>
</x-app-layout>
