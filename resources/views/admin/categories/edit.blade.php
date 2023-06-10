<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}"/>
    <x-setting :heading="'Edit Category: ' . $category->name">
        <form method="POST" action="{{ route('categories.update', ['category' =>$category->id]) }}">
            @csrf
            @method('PATCH')

            <p class="text-sm">All fields marked with * are required</p>

            <x-form.input name="name" type="text" :value="old('name', $category->name)">*</x-form.input>
            <x-form.input name="slug" type="text" :value="old('slug', $category->slug)">*</x-form.input>

            <x-primary-button class="mt-4">Update</x-primary-button>
        </form>
    </x-setting>
    <x-footer/>
</x-layout>
