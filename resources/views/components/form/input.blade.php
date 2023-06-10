@props(['name', 'type', 'label'])

<div>
    <x-form.input-label class="{{ $name }}" for="{{ $name }}">{{ $label ?? ucwords($name) }}{{ $slot }}</x-form.input-label>
    <input class="{{ $name }} border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full dark:bg-slate-800 dark:text-white"
           type="{{ $type }}"
           name="{{ $name }}"
           {{ $attributes(['value' => old($name)]) }}
    >

    <x-form.input-error name="{{ $name }}" />
</div>
