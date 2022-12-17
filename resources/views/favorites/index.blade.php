<x-layout>
    <x-header favorites="{{ $favorites }}"  />
        <main>
            @foreach($favoriteBooks as $favorite)
                <div class="flex grid grid-cols-5 border-2 m-2 h-40">
                    <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 w-24 h-32 mt-4 ml-10">

                    <p class="text-center place-self-center"> {{ $favorite->book->title}}</p>

                    <p class="text-center place-self-center text-red-500"> ${{ $favorite->book->price}}</p>

                    <p class="text-center place-self-center"> {{ $favorite->book->pages}} pages</p>

                    <form method="POST" action="/favorites/{{ $favorite->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-white w-36 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm ml-20 my-14 ">Remove from favorites</button>
                    </form>
                </div>
            @endforeach
        </main>
    <x-footer />
</x-layout>
