<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2']) }}>
    {{ $slot }}
</button>
