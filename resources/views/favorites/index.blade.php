<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}" />
    <main>
        @if($favorites==0)
            <p>No books in favorites</p>
        @else
            <div class="mt-14">
                @foreach($favoriteBooks as $favorite)
                    <div class="flex grid grid-cols-5 border-2 m-2 h-40">
                        @if($favorite->book->cover == null)
                            <a href="{{ route('book.show', ['slug' => $favorite->book->slug]) }}"><img src="{{ asset('images/imageNotAvailable.png') }}" alt="{{ $favorite->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @else
                            <a href="{{ route('book.show', ['slug' => $favorite->book->slug]) }}"><img src="{{ asset('storage/' . $favorite->book->cover) }}" alt="{{ $favorite->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @endif
                        <a href="{{ route('book.show', ['slug' => $favorite->book->slug]) }}" class="text-center place-self-center hover:text-blue-600 focus:text-blue-900"> {{ $favorite->book->title }}</a>

                        <p class="text-center place-self-center text-red-500"> ${{ $favorite->book->price }}</p>

                        <p class="text-center place-self-center"> {{ $favorite->book->pages }} pages</p>

                        <div class="place-self-center">
                            <form method="POST" action="{{ route('cart.store', ['book' => $favorite->book->slug]) }}">
                                @csrf

                                <x-primary-button
                                    class="w-36  bg-amber-400 hover:bg-amber-500 focus:ring-1 focus:ring-amber-300 mb-1">Add to
                                    cart
                                </x-primary-button>
                            </form>

                            <form method="POST" action="{{ route('favorites.delete', ['favorite' => $favorite->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-white w-36 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm mt-1">
                                    Remove from favorites
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach

                <div class="mt-2">
                    {{ $favoriteBooks->links() }}
                </div>
            </div>
        @endif
    </main>
    <x-footer/>
</x-layout>
