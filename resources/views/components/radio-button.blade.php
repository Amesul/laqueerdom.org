@props([
    'fieldName',
    'elementName',
    'checked' => null
    ])

<div class="flex items-center gap-x-3">
    <input id="{{ $elementName }}" name="{{ $fieldName }}" value="{{ $elementName }}" {{ $checked }} type="radio"
           class="h-4 w-4 border-gray-300 text-accent focus:ring-accent">
    <label for="{{ $elementName }}"
           class="block text-sm font-medium leading-6 text-gray-900">{{ $slot }}</label>
</div>
