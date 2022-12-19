<x-layout>
    <x-header favorites="{{ $favorites }}"  />
    <main>
        @if($cartItems == 0)
            <p>No books in the cart</p>
        @else
            @foreach($buyItems as $buyItem)
                <div class="flex grid grid-cols-5 border-2 m-2 h-40">
                    <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 w-24 h-32 mt-4 ml-10">

                    <p class="text-center place-self-center"> {{ $buyItem->book->title}}</p>

                    <p class="text-center place-self-center text-red-500"> ${{ $buyItem->book->price}}</p>

                    <p class="text-center place-self-center"> {{ $buyItem->book->pages}} pages</p>

                    <form method="POST" action="/cart/{{ $buyItem->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-white w-36 h-12 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm mx-20 my-14 ">Remove from cart</button>
                    </form>
                </div>
            @endforeach
            <form method="POST" action="/cart" class="grid justify-items-center ">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-white w-36 h-12 bg-blue-500 hover:bg-blue-700 focus:ring-4  font-medium rounded-3xl text-sm">Buy</button>
            </form>
        @endif
    </main>
    <x-footer />
</x-layout>
