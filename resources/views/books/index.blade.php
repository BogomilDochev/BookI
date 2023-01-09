<x-layout>
    <x-header favorites="{{ $favorites }}" cartItems="{{ $cartItems }}" />

    <main class="flex pl-20 pr-12 pt-10">

        {{--categories section--}}
        <div class="w-1/5 flex-col">
            <h2 class="text-xl border-b-2 border-gray-300">Categories</h2>
            <ul class="list-none pt-5">
                @foreach($categories as $category)
                    <li>
                        <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page', 'sort')) }}"
                           :active="request()->is('categories/{$category->slug}')">
                            {{ ucwords($category->name) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{--main section of all books--}}
        <div class="w-4/5 pl-10 flex-col">
            <div class="grid grid-cols-1 border-b-2 border-gray-300">
                <h2 class="col-span-1 text-xl ">Books</h2>

                <div class="col-start-5">
                    <div x-data="{ show: false }" @click.away="show = false" class="relative">
                        <div @click="show = ! show">
                            <button
                                class="py-2 pl-3 text-sm font-semibold w-full lg:w-52 place-content-end flex inline-flex">
                                {{ $currentSort }}
                                <svg class="transform -rotate-90" width="22"
                                     height="22" viewBox="0 0 22 22">
                                    <g fill="none" fill-rule="evenodd">
                                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5"
                                              d="M21 1v20.16H.84V1z">
                                        </path>
                                        <path class="fill-black dark:fill-white"
                                              d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <div x-show="show"
                             class="py-2 absolute bg-gray-100 dark:bg-blue-900 dark:text-white w-full mt-2 rounded-xl z-50 overflow-auto max-h-52"
                             style="display: none">
                            <x-sort-item
                                href="/?sort=price&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Lowest price
                            </x-sort-item>
                            <x-sort-item
                                href="/?sort=price&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Highest price
                            </x-sort-item>
                            <x-sort-item
                                href="/?sort=created_at&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Newest
                            </x-sort-item>
                            <x-sort-item
                                href="/?sort=created_at&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Oldest
                            </x-sort-item>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:grid lg:grid-cols-4 gap-x-20 gap-y-4 pt-5">
                @if($books->count())
                    @foreach($books as $book)
                        <div
                            class="col-span-1 flex-col grid justify-items-center border-2 h-96 w-52 shadow-lg overflow-auto">
                            @if($book->cover == null)
                                <img src="/images/imageNotAvailable.png" alt="{{ $book->title }}"
                                     class="shrink-0 h-44 w-28 pt-2">
                            @else
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                     class="shrink-0 h-44 w-28 pt-2">
                            @endif
                            <div class="relative">
                                <p class="absolute left-1/2 -top-3 transform -translate-x-1/2  w-48 text-base font-semibold text-center">{{ $book->title }}</p>
                                <p class="absolute left-1/2 top-10 transform -translate-x-1/2  w-48 text-sm text-center">{{ $book->author}}</p>
                            </div>
                            <div class="grid grid-cols-1 grid-rows-3 place-self-center mt-12">
                                <p class="text-xl text-red-500 text-center">${{ $book->price }}</p>
                                <x-primary-button onclick="location.href='/books/{{ $book->slug }}';"
                                                  class="h-8">Review
                                </x-primary-button>
                                <form method="POST" action="/books/{{ $book->slug }}/cart">
                                    @csrf
                                    <x-primary-button
                                        class="w-28 bg-red-500 hover:bg-red-700 focus:ring-1 focus:ring-red-300">Add to
                                        cart
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="col-span-2">No books yet. Please check back later.</p>
                @endif
            </div>

            {{--links to the pagination--}}
            {{ $books->links() }}
        </div>
    </main>
    <x-footer/>

</x-layout>


