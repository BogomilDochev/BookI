<x-layout>
    <main class="flex pl-20 pr-12 pt-10 gap-x-28">
        <div id="bookBorder" class="w-1/5 flex-col" >
            <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 h-100 w-72  shadow-3xl ">
        </div>
        <div class="w-2/5 flex-col">
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
        <div class="w-1/5 flex-col" >
            <div class="h-72 w-72  shadow-3xl ">
                <p class="text-xl font-semibold p-5">Price: <span class="text-xl text-red-500">{{ $book->price }}</span></p>
                <div class="relative">
                    <div class="absolute top-16 left-9  grid grid-cols-3  justify-items-center ">
                        <div class="col-start-2 col-span-3 ">
                            <button class="bg-slate-200 hover:bg-slate-400 font-medium rounded-full text-sm w-6 h-6"  onClick='decreaseCount(event, this)'>-</button>
                            <input class="rounded-lg border-2 text-center w-12" type="number" value="1">
                            <button class=" bg-slate-200 hover:bg-slate-400 font-medium rounded-full text-sm w-6 h-6"  onClick='increaseCount(event, this)'>+</button>
                        </div>
                    </div>
                    <button class="absolute top-28 inset-x-1/4 text-white w-36 bg-red-500 hover:bg-red-700 focus:ring-4  font-medium rounded-3xl text-sm px-4 py-2 h-9">Add to cart</button>
                    <button class="absolute top-40 inset-x-1/4 text-white w-36 bg-amber-400 hover:bg-amber-500 focus:ring-4  font-medium rounded-3xl text-sm px-4 py-2 h-9">Add to wishlist</button>
                </div>
               </div>
        </div>
    </main>
</x-layout>
