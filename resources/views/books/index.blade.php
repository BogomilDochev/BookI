<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}" />

    <main class="grid grid-cols-5 pl-20 pr-12 pt-10">

        {{--categories section--}}
        <div class="col-span-1">
            <h2 class="text-xl border-b-2 border-gray-300">Categories</h2>
            <ul class="list-none pt-5">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('home', ['category' => $category->slug]) }}&{{ http_build_query(request()->except('category', 'page', 'sort')) }}">
                            {{ ucwords($category->name) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{--main section of all books--}}
        <div class="col-span-4 pl-10">
            <div class="grid grid-cols-1 border-b-2 border-gray-300">
                <h2 class="col-span-1 text-xl ">Book</h2>

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
                                href="{{ route('home') }}?sort=price&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Lowest price
                            </x-sort-item>
                            <x-sort-item
                                href="{{ route('home') }}?sort=price&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Highest price
                            </x-sort-item>
                            <x-sort-item
                                href="{{ route('home') }}?sort=created_at&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
                                Newest
                            </x-sort-item>
                            <x-sort-item
                                href="{{ route('home') }}?sort=created_at&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">
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
                                <img src="{{ asset('images/imageNotAvailable.png') }}" alt="{{ $book->title }}"
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
                                <x-primary-button onclick="location.href='{{ route('book.show', ['slug' => $book->slug]) }}';"
                                                  class="h-8">Review
                                </x-primary-button>

                                @if($book->in_stock_quantity>0)
                                    <form method="POST" action="{{ route('cart.store', ['book' => $book->slug]) }}">
                                        @csrf
                                        <x-primary-button
                                            class="w-28 bg-red-500 hover:bg-red-700 focus:ring-1 focus:ring-red-300">Add to
                                            cart
                                        </x-primary-button>
                                    </form>
                                @else
                                    <p class="pt-2">Not available</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="col-span-2">No books yet. Please check back later.</p>
                @endif
            </div>

            {{--links to the pagination--}}
            <div class="mt-2">
                {{ $books->links() }}
            </div>

        </div>
        <div class="col-span-5 place-self-center grid justify-items-center bg-gray-100 px-96 py-10 mt-6 rounded-3xl dark:bg-slate-800">
            <p class="text-3xl text-center">Stay in touch with the latest books</p>
            <form method="POST" action="{{ route('newsletter') }}">
                @csrf
                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-3 w-full dark:bg-slate-800 dark:text-white"
                       type="text"
                       name="email"
                       placeholder="Your email address"
                >

                <x-form.input-error name="email" />

                <x-primary-button class="h-10 w-96 mt-4">Subscribe for updates</x-primary-button>
            </form>
        </div>
    </main>
    <x-footer/>

</x-layout>


