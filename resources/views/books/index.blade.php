<x-layout>
    <x-header />

        <main class="flex pl-20 pr-12 pt-10">
            <div class="w-1/5 flex-col">
                <h2 class="text-xl border-b-2 border-gray-300">Categories</h2>
                <ul class="list-none pt-5">
                    @foreach($categories as $category)
                        <li><a href="/">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="w-4/5 pl-10 flex-col">
                <h2 class="text-xl border-b-2 border-gray-300">Books</h2>
                <div class="lg:grid lg:grid-cols-4 gap-x-20 gap-y-4 pt-5">
                    <div class="col-span-1 flex-col grid justify-items-center border-2 h-96 w-52 shadow-lg overflow-auto">
                        <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 h-40 w-28 pt-2">
                        <div class="relative">
                            <p class="absolute left-1/2 -top-16 transform -translate-x-1/2  w-48 text-base font-semibold text-center">The Great Gatsby</p>
                            <p class="absolute left-1/2 top-8 transform -translate-x-1/2  w-48 text-sm text-center">F. Scott Fitzgerald</p>
                        </div>
                        <div class="relative">
                            <p class="text-xl text-red-500 absolute bottom-12 -right-7">$7.99</p>
                            <button onclick="location.href='/';" class="text-white absolute bottom-2 -right-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2 h-9">Review</button>
                        </div>
                    </div>

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

                </div>
            </div>
        </main>
    <x-footer />

</x-layout>


