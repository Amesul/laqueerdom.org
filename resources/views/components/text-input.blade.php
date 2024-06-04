@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'valid:border-green-500 invalid:border-red-500 border-secondary-200 focus:border-accent-300 border-1 focus:ring-accent-300 rounded-md shadow-sm']) !!}>
