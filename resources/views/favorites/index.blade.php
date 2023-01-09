<x-layout>
    <x-header favorites="{{ $favorites }}" cartItems="{{ $cartItems }}"/>
    <main>
        @if($favorites==0)
            <p>No books in favorites</p>
        @else
            <div class="mt-14">
                @foreach($favoriteBooks as $favorite)
                    <div class="flex grid grid-cols-5 border-2 m-2 h-40">
                        @if($favorite->book->cover == null)
                            <a href="/books/{{ $favorite->book->slug }}"><img src="/images/imageNotAvailable.png" alt="{{ $favorite->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @else
                            <a href="/books/{{ $favorite->book->slug }}"><img src="{{ asset('storage/' . $favorite->book->cover) }}" alt="{{ $favorite->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @endif
                        <a href="/books/{{ $favorite->book->slug }}" class="text-center place-self-center hover:text-blue-600 focus:text-blue-900"> {{ $favorite->book->title }}</a>

                        <p class="text-center place-self-center text-red-500"> ${{ $favorite->book->price }}</p>

                        <p class="text-center place-self-center"> {{ $favorite->book->pages }} pages</p>

                        <form method="POST" action="/favorites/{{ $favorite->id }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-white w-36 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm mx-20 my-14 ">
                                Remove from favorites
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
    <x-footer/>
</x-layout>
