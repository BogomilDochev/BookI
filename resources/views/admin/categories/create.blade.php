<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}"/>
    <x-setting heading="Add New Category">
        <form method="POST" action="{{ route('admin.categories') }}">
            @csrf

            <p class="text-sm">All fields marked with * are required</p>

            <x-form.input name="name" type="text" label="Category">*</x-form.input>

            <x-primary-button class="mt-4">Add</x-primary-button>
        </form>
    </x-setting>

    <x-footer/>
</x-layout>

