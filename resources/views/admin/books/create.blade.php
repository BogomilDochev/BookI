<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}"/>
    <x-setting heading="Publish New Book">
        <form method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">
            @csrf

            <p class="text-sm">All fields marked with * are required</p>

            <x-form.input name="title" type="text">*</x-form.input>
            <x-form.input name="cover" type="file"/>
            <x-form.input name="author" type="text">*</x-form.input>
            <x-form.input name="publisher" type="text">*</x-form.input>
            <x-form.input name="in_stock_quantity" type="number" label="Quantity in stock">*</x-form.input>

            <div>
                <x-form.input-label for="category">Category*</x-form.input-label>
                <select
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-96 h-8 dark:bg-slate-800 dark:text-white"
                    name="category_id"
                    id="category_id"
                >
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.input-error name="category">*</x-form.input-error>
            </div>

            <div>
                <x-form.input-label for="description">Description*</x-form.input-label>
                <textarea class="border border-gray-200 p-2 w-96 rounded h-36 dark:bg-slate-800 dark:text-white"
                          name="description"
                          id="description"
                          required
                >{{ old('description')}}</textarea>
                <x-form.input-error name="description"/>
            </div>

            <x-form.input name="price" type="number">*</x-form.input>
            <x-form.input name="date" type="date" label="Publish Date">*</x-form.input>
            <x-form.input name="pages" type="number">*</x-form.input>
            <x-form.input name="dimensions" type="text">*</x-form.input>
            <x-form.input name="languages" type="text">*</x-form.input>
            <x-form.input name="type" type="text">*</x-form.input>

            <x-primary-button class="mt-4">Publish</x-primary-button>
        </form>
    </x-setting>

    <x-footer/>
</x-layout>
