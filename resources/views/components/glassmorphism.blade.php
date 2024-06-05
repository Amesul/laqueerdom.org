<div
    class="before:absolute relative z-0 before:-z-10 before:h-full before:w-full before:bg-sky-100/50 shadow-xl before:backdrop-blur-2xl before:backdrop-brightness-[3.5] text-primary before:sm:rounded-xl">
    <div {{ $attributes->merge(['class' => '']) }}>
        {{ $slot }}
    </div>
</div>
