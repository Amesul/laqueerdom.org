<textarea {{ $attributes->merge([
    'class' => 'focus-visible:outline-accent focus:ring ring-accent'
]) }}>{{ $slot }}</textarea>
