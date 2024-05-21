<div class="shadow-md mt-1">
    <textarea {{ $attributes->merge([
    'class' => 'focus-visible:outline-accent focus:ring ring-accent']) }}>{{ $slot }}</textarea>
</div>
