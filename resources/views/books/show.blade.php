<x-layout>
    <main class="flex pl-20 pr-12 pt-10 gap-x-20">
        <div class="w-1/5 flex-col">
            <img src="/images/TheGreatGatsbyBook.jpg" alt="The Great Gatsby Book" class="shrink-0 h-100 w-72  shadow-3xl">
        </div>
        <div class="w-2/5 flex-col">
            <p class="text-3xl font-bold">{{$book->title}}</p>
            <p class="pt-4 text-slate-500 text-lg">{{$book->author}} (Author)</p>
            <div class="pt-4">
                <p class="text-2xl font-semibold">Description</p>
                <p>{!! $book->description !!}</p>
            </div>
            <div class="pt-4">
                <p class="text-2xl font-semibold">Product Details</p>
                <p>Publisher:</p>
                <p>Publish Date:</p>
                <p>Pages:</p>
                <p>Dimensions:</p>
                <p>Languages:</p>
                <p>Type:</p>
                <p>Categories</p>
            </div>
        </div>
    </main>
</x-layout>
