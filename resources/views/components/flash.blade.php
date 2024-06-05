@props(['type'])

@php if($type === 'info') $color = 'bg-blue-200'; if ($type === 'danger') $color = 'bg-red-200'; if($type === 'success') $color ='bg-green-200'; @endphp

<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 10_000)"
     x-show="show"
     x-transition.opacity x-transition.duration.700ms
     class="fixed bottom-8 left-8 z-40 mt-2 flex origin-center items-center gap-4 rounded-xl bg-white px-4 py-2 shadow-xl">
    <div class="grid h-8 w-8 place-content-center rounded-full {{ $color }} text-lg">
        @if($type === 'info')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
            </svg>
        @elseif($type === 'danger')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
            </svg>
        @elseif($type === 'success')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
        @endif
    </div>
    <p class="rounded-md {{ $color }} px-2 text-sm py-0.5">{{ $slot }}</p>
    <button @click="show = false">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
        </svg>
    </button>
    <span class="hidden bg-blue-200 bg-red-200 bg-green-200">Register classes</span>
</div>
