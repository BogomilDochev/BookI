<x-layout>
    <x-header favorites="{{ $favorites }}" cartItems="{{ $cartItems }}"/>
    <main>
        @if($cartItems == 0)
            <p>No books in the cart</p>
        @else
            <div class="mt-14">
                @foreach($buyItems as $buyItem)
                    <div class="flex grid grid-cols-6 border-2 m-2 h-40">
                        @if($buyItem->book->cover == null)
                            <a href="/books/{{ $buyItem->book->slug }}"><img src="/images/imageNotAvailable.png" alt="{{ $buyItem->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @else
                            <a href="/books/{{ $buyItem->book->slug }}"><img src="{{ asset('storage/' . $buyItem->book->cover) }}" alt="{{ $buyItem->book->title }}"
                                 class="shrink-0 w-24 h-32 mt-4 ml-10"></a>
                        @endif
                        <a href="/books/{{ $buyItem->book->slug }}" class="text-center place-self-center hover:text-blue-600 focus:text-blue-900"> {{ $buyItem->book->title }}</a>

                        <p class="price text-center place-self-center text-red-500">{{ $buyItem->book->price }}</p>

                        <p class="text-center place-self-center"> {{ $buyItem->book->pages }} pages</p>

                        <div class="grid grid-cols-3 place-self-center">
                            <form method="POST" action="/cart/{{ $buyItem->id }}/decrease">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-amber-400 w-7 rounded-full text-xl">-</button>
                            </form>
                            <p class="text-center"> {{ $buyItem->productQuantity }}</p>
                            <form method="POST" action="/cart/{{ $buyItem->id }}/increase">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-amber-400 w-7 rounded-full text-xl">+</button>
                            </form>
                        </div>

                        <form method="POST" action="/cart/{{ $buyItem->id }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-white w-36 h-12 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm mx-20 my-14 ">
                                Remove from cart
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <p id="total" class="text-right text-3xl font-semibold pr-4">Total: {{ $total }}</p>

            <form method="POST" action="/cart" class="grid justify-items-center ">
                @csrf
                @method('DELETE')
                <x-primary-button class="w-36 h-12">Buy</x-primary-button>
            </form>

        @endif
    </main>
    <x-footer/>
</x-layout>
