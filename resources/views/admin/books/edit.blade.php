<x-layout>
    <x-header favorites="{{ $favorites }}" />
        <x-setting :heading="'Edit Book: ' . $book->title">
            <form method="POST" action="/admin/books/{{ $book->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="w-96">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('name', $book->title)"/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="slug" :value="__('Slug')" />
                    <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug', $book->slug)" />
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                </div>

                <div class="flex mt-6">
                    <div class="flex-1">
                        <x-text-input name="cover" type="file" :value="old('cover', $book->cover)"/>
                    </div>

                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="rounded-xl ml-6" width="100">
                    <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="author" :value="__('Author')" />
                    <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author', $book->author)" />
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="publisher" :value="__('Publisher')" />
                    <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher" :value="old('publisher', $book->publisher)" />
                    <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-8" name="category_id" id="category_id">
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

                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea class="border border-gray-200 p-2 w-full rounded h-36"
                              name="description"
                              id="description"
                              required
                    >{{ old('description', $book->description)}}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $book->price)" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="date" :value="__('Publish Date')" />
                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', $book->date)" />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="pages" :value="__('Pages')" />
                    <x-text-input id="pages" class="block mt-1 w-full" type="number" name="pages" :value="old('pages', $book->pages)" />
                    <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="dimensions" :value="__('Dimensions')" />
                    <x-text-input id="dimensions" class="block mt-1 w-full" type="text" name="dimensions" :value="old('dimensions', $book->dimensions)" />
                    <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="languages" :value="__('Languages')" />
                    <x-text-input id="languages" class="block mt-1 w-full" type="text" name="languages" :value="old('languages', $book->languages)" />
                    <x-input-error :messages="$errors->get('languages')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="type" :value="__('Type')" />
                    <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', $book->type)" />
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2 mt-4">Update</button>
            </form>
        </x-setting>

    <x-footer />
</x-layout>
