@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'valid:border-green-500 border-secondary-200 focus:border-accent focus:ring-accent rounded-md shadow-sm']) !!}>
