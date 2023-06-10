@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 pt-3 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
