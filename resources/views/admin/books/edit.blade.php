<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}"/>
    <x-setting :heading="'Edit Book: ' . $book->title">
        <form method="POST" action="{{ route('books.update', ['book' => $book->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <p class="text-sm">All fields marked with * are required</p>

            <x-form.input name="title" type="text" :value="old('title', $book->title)">*</x-form.input>
            <x-form.input name="slug" type="text" :value="old('slug', $book->slug)">*</x-form.input>

            <div class="flex ">

                <div class="flex-1">
                    <x-form.input-label for="cover">Cover</x-form.input-label>
                    <x-form.text-input name="cover" type="file" :value="old('cover', $book->cover)"/>
                </div>

                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="rounded-xl ml-6 mt-6"
                     width="100">
                <x-form.input-error name="cover"/>
            </div>

            <x-form.input name="author" type="text" :value="old('author', $book->author)">*</x-form.input>
            <x-form.input name="publisher" type="text" :value="old('publisher', $book->publisher)">*</x-form.input>
            <x-form.input name="in_stock_quantity" type="number" label="Quantity in stock" :value="old('inStockQuantity', $book->in_stock_quantity)">*</x-form.input>

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
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.input-error name="category"/>
            </div>

            <div>
                <x-form.input-label for="description">Description*</x-form.input-label>
                <textarea class="border border-gray-200 p-2 w-96 rounded h-36 dark:bg-slate-800 dark:text-white"
                          name="description"
                          id="description"
                          required
                >{{ old('description', $book->description)}}
                </textarea>
                <x-form.input-error name="description"/>
            </div>

            <x-form.input name="price" type="number" :value="old('price', $book->price)">*</x-form.input>
            <x-form.input name="date" type="date" label="Publish Date" :value="old('date', $book->date)">*</x-form.input>
            <x-form.input name="pages" type="number" :value="old('pages', $book->pages)">*</x-form.input>
            <x-form.input name="dimensions" type="text" :value="old('dimensions', $book->dimensions)">*</x-form.input>
            <x-form.input name="languages" type="text" :value="old('languages', $book->languages)">*</x-form.input>
            <x-form.input name="type" type="text" :value="old('type', $book->type)">*</x-form.input>

            <x-primary-button class="mt-4">Update</x-primary-button>
        </form>
    </x-setting>
    <x-footer/>
</x-layout>
