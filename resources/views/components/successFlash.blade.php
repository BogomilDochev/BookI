@if(session()->has('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed right-3 bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 text-sm"
    >
        <p>{{ session('error') }}</p>
    </div>
@endif
