<x-layout>
    <x-header />

        <main class="flex pl-20 pr-12 pt-10">
            <div class="w-1/5 flex-col">
                <h2 class="text-xl border-b-2 border-gray-300">Categories</h2>
                <ul class="list-none pt-5">
                    @foreach($categories as $category)
                        <li><a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page', 'sort')) }}"
                                 :active="request()->is('categories/{$category->slug}')">
                                {{ ucwords($category->name) }}
                            </a></li>
                    @endforeach
                </ul>
            </div>

            <div class="w-4/5 pl-10 flex-col">
                <div class="grid grid-cols-1 border-b-2 border-gray-300">
                    <h2 class="col-span-1 text-xl ">Books</h2>

                    <div class="col-span-2 col-start-5">
                        <div x-data="{ show: false }" @click.away="show = false" class="relative">
                            <div @click="show = ! show">
                                <button class="py-2 pl-3 text-sm font-semibold w-full lg:w-52 place-content-end flex inline-flex">
                                    Sort by:
                                    <svg class = "transform -rotate-90" width="22"
                                         height="22" viewBox="0 0 22 22">
                                        <g fill="none" fill-rule="evenodd">
                                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                            </path>
                                            <path fill="#222"
                                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>

                            <div x-show = "show" class = "py-2 absolute bg-gray-100 w-full mt-2 rounded-xl z-50 overflow-auto max-h-52" style="display: none">
                                <a class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white" href="/?sort=price&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">Lowest price</a>
                                <a class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white" href="/?sort=price&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">Highest price</a>
                                <a class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white" href="/?sort=created_at&direction=asc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">Newest</a>
                                <a class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white" href="/?sort=created_at&direction=desc&{{ http_build_query(request()->except('page', 'sort', 'direction')) }}">Oldest</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:grid lg:grid-cols-4 gap-x-20 gap-y-4 pt-5">
{{--                    <div class="col-span-1 flex-col grid justify-items-center border-2 h-96 w-52 shadow-lg overflow-auto">--}}
{{--                        <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 h-40 w-28 pt-2">--}}
{{--                        <div class="relative">--}}
{{--                            <p class="absolute left-1/2 -top-16 transform -translate-x-1/2  w-48 text-base font-semibold text-center">The Great Gatsby</p>--}}
{{--                            <p class="absolute left-1/2 top-8 transform -translate-x-1/2  w-48 text-sm text-center">F. Scott Fitzgerald</p>--}}
{{--                        </div>--}}
{{--                        <div class="relative">--}}
{{--                            <p class="text-xl text-red-500 absolute bottom-12 -right-7">$7.99</p>--}}
{{--                            <button onclick="location.href='/';" class="text-white absolute bottom-2 -right-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2 h-9">Review</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    @if($books->count())
                        @foreach($books as $book)
                            <div class="col-span-1 flex-col grid justify-items-center border-2 h-96 w-52 shadow-lg overflow-auto">
                                <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 h-40 w-28 pt-2">
                                <div class="relative">
                                    <p class="absolute left-1/2 -top-16 transform -translate-x-1/2  w-48 text-base font-semibold text-center">{{ $book->title }}</p>
                                    <p class="absolute left-1/2 top-8 transform -translate-x-1/2  w-48 text-sm text-center">{{ $book->author->name }}</p>
                                </div>
                                <div class="relative">
                                    <p class="text-xl text-red-500 absolute bottom-12 -right-7">${{ $book->price }}</p>
                                    <button onclick="location.href='/books/{{ $book->slug }}';" class="text-white absolute bottom-2 -right-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2 h-9">Review</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="col-span-2">No books yet. Please check back later.</p>
                    @endif
                </div>
                {{--            links to the pagination (different pages of posts)--}}
                {{ $books->links() }}
            </div>
        </main>
    <x-footer />

</x-layout>


