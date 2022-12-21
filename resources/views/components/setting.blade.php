@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                <li>
                    <a href="/admin/books" class="{{ request()->is('admin/books') ? 'text-blue-500' : '' }}">All Books</a>
                </li>

                <li>
                    <a href="/admin/books/create" class="{{ request()->is('admin/books/create') ? 'text-blue-500' : '' }}">New Book</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <div  class="border border-gray-200 p-6 rounded-xl">
                {{ $slot }}
            </div>
        </main>
    </div>
</section>
