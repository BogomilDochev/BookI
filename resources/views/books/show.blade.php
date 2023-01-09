<x-layout>
    <x-header favorites="{{ $favorites }}" cartItems="{{ $cartItems }}" />
    <main class=" pt-10 grid grid-cols-3 ">

        {{--section displaying the cover--}}
        <div id="bookBorder" class="pl-20">
            @if($book->cover == null)
                <img src="/images/imageNotAvailable.png" alt="{{ $book->title }}" class="h-100 w-3/5  shadow-3xl">
            @else
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                     class="h-100 w-3/5  shadow-3xl">
            @endif
        </div>

        {{--section displaying the information for a book--}}
        <div>
            <p class="text-3xl font-bold">{{$book->title}}</p>
            <p class="pt-4 text-slate-500 text-lg">{{$book->author}} (Author)</p>
            <div class="pt-4">
                <p class="text-2xl font-semibold">Description</p>
                <p>{!! $book->description !!}</p>
            </div>
            <div class="pt-4">
                <p class="text-2xl font-semibold">Product Details</p>
                <p>Publisher: {{ $book->publisher }}</p>
                <p>Publish Date: {{$book->date}}</p>
                <p>Pages: {{ $book->pages }}</p>
                <p>Dimensions: {{$book->dimensions}}</p>
                <p>Languages: {{ $book->languages }}</p>
                <p>Type: {{ $book->type }}</p>
                <p>Category: {{ $book->category->name }}</p>
            </div>
        </div>

        {{--section with buttons for adding to cart or wishlist--}}
        <div class="pl-28">
            <div class="h-72 w-9/12  shadow-3xl dark:bg-blue-900">
                <p class="text-xl font-semibold p-5">Price: <span class="text-xl text-red-500">{{ $book->price }}</span>
                </p>
                <div class="grid grid-cols-1 grid-rows-3 pt-32">
                    @auth
                        <div class="grid grid-cols-1 grid-rows-2 place-self-center">
                            <form method="POST" action="/books/{{ $book->slug }}/favorites">
                                @csrf
                                <x-primary-button
                                    class="w-36 bg-amber-400 hover:bg-amber-500 focus:ring-1 focus:ring-amber-300">Add
                                    to wishlist
                                </x-primary-button>
                            </form>

                            <form method="POST" action="/books/{{ $book->slug }}/cart">
                                @csrf
                                <x-primary-button
                                    class="w-36 bg-red-500 hover:bg-red-700 focus:ring-1 focus:ring-red-300 mb-1">Add to
                                    cart
                                </x-primary-button>
                            </form>

                        </div>
                    @else
                        <p class="font-semibold text-center pt-8">
                            <a href="/register" class="hover:underline">Register </a>or <a href="/login"
                                                                                           class="hover:underline">Log
                                in</a> to add the book to your favorites or to buy it.
                        </p>
                    @endauth
                </div>
            </div>
        </div>

        {{--Comments section--}}
        <div class="pt-10 pl-20">
            <h2 class="text-xl border-b-2 border-gray-300">Comments:</h2>
            @auth
                <div class="border border-gray-200 p-6 rounded-xl">
                    <form method="POST" action="/books/{{ $book->slug }}/comments">
                        @csrf

                        <header class="flex items-center">
                            <img src="/images/avatars/{{ Auth::user()->avatar }}"
                                 alt="Avatar of the user"
                                 width="40"
                                 height="40"
                                 class="rounded-full">

                            <h2 class="ml-4">Want to participate?</h2>
                        </header>

                        <div class="mt-6">
                <textarea
                    name="body"
                    class="w-full text-sm dark:bg-slate-800"
                    rows="5"
                    placeholder="Quick, thing of something to say"
                    required></textarea>

                            @error('body')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                            <x-primary-button class="w-28">Post</x-primary-button>
                        </div>
                    </form>

                </div>
            @else
                <p class="font-semibold">
                    <a href="/register" class="hover:underline">Register </a>or <a href="/login" class="hover:underline">Log in</a> to leave a comment.
                </p>
            @endauth
            @if(count($book->comment) > 0)
                <section class="mt-10 space-y-6">
                    @foreach($book->comment as $comment)
                        <article class="flex space-x-4 bg-gray-50 rounded-xl dark:bg-blue-900">
                            <div class="flex-shrink-0">
                                <img src="/images/avatars/{{ $comment->user->avatar }}" alt="" width="60" height="60"
                                     class="rounded-full">
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
    <x-footer/>
</x-layout>
