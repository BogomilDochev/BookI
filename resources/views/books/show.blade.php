<x-layout>
    <x-header />
        <main class=" pt-10  grid grid-cols-3 ">
            <div id="bookBorder" class="pl-20" >
                <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class=" h-100 w-3/5  shadow-3xl ">
            </div>
            <div class="">
                <p class="text-3xl font-bold">{{$book->title}}</p>
                <p class="pt-4 text-slate-500 text-lg">{{$book->author->name}} (Author)</p>
                <div class="pt-4">
                    <p class="text-2xl font-semibold">Description</p>
                    <p>{!! $book->description !!}</p>
                </div>
                <div class="pt-4">
                    <p class="text-2xl font-semibold">Product Details</p>
                    <p>Publisher: {{ $book->publisher->name }}</p>
                    <p>Publish Date: {{$book->date}}</p>
                    <p>Pages: {{ $book->pages }}</p>
                    <p>Dimensions: {{$book->dimensions}}</p>
                    <p>Languages: {{ $book->languages }}</p>
                    <p>Type: {{ $book->type }}</p>
                    <p>Category: {{ $book->category->name }}</p>
                </div>
            </div>
            <div class="pl-28 " >
                <div class="h-72 w-9/12  shadow-3xl">
                    <p class="text-xl font-semibold p-5">Price: <span class="text-xl text-red-500">{{ $book->price }}</span></p>
                    <div class="grid grid-cols-1 grid-rows-3 pt-16">
                        <div class="place-self-center">
                            <div class="col-start-2 col-span-3 ">
                                <button class="bg-slate-200 hover:bg-slate-400 font-medium rounded-full text-sm w-6 h-6"  onClick='decreaseCount(event, this)'>-</button>
                                <input class="rounded-lg border-2 text-center w-12" type="number" value="1">
                                <button class="bg-slate-200 hover:bg-slate-400 font-medium rounded-full text-sm w-6 h-6"  onClick='increaseCount(event, this)'>+</button>
                            </div>
                        </div>
                        <button class=" place-self-center text-white w-36 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm px-4 py-2 h-9">Add to cart</button>
                        <button class=" place-self-center text-white w-36 bg-amber-400 hover:bg-amber-500 focus:ring-4  font-medium rounded-3xl text-sm px-4 py-2 h-9">Add to wishlist</button>
                    </div>
                   </div>
            </div>

            <div class="pt-10 pl-20">
                <h2 class="text-xl border-b-2 border-gray-300">Comments:</h2>
                @if(count($book->comment) > 0)
                    <section class="mt-10 space-y-6">
                        @foreach($book->comment as $comment)
                            <article class="flex space-x-4 bg-gray-50">
                                <div class="flex-shrink-0">
                                    <img src="/images/{{ $comment->user->avatar }}" alt="" width="60" height="60" class="rounded-xl">
                                </div>

                                <div>
                                    <header class="mb-4">
                                        <h3 class="font-bold">{{ $comment->user->name }}</h3>
                                        <p class="text-xs">Posted
                                            <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                                        </p>
                                    </header>

                                    <p>
                                        {{ $comment->body }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </section>
                @else
                    <p>No comments yet</p>
                @endif
            </div>
        </main>
    <x-footer />
</x-layout>
