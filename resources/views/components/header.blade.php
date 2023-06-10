@props(['favorites', 'numberOfCartItems'])

<header class="flex justify-between border-b-2 border-blue-300 pl-10 pr-5">
    <div class="pt-3">
        <x-application-logo />
    </div>

    <div class="w-1/3 pt-6 w-2/4 shrink-0">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>

                <form method="GET" action="{{ route('home') }}">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <input
                        type="search"
                        name="search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 rounded-3xl border border-gray-300 bg-gray-50 dark:bg-slate-800 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for books.."
                        value="{{ request('search') }}"
                    >
                        <x-primary-button class="absolute right-2.5 bottom-2.5">Search</x-primary-button>
                </form>
            </div>
    </div>

    @auth
        <div class="flex pt-8">
            <div class="flex pr-4">

                <x-dropdown class="items-center pt-2 pr-5 cursor-pointer">
                    <x-slot name="trigger" class="">
                        <button class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</button>
                        <svg class = "transform -rotate-90 flex inline-flex " width="22"
                             height="22" viewBox="0 0 22 22">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-black dark:fill-white"
                                      d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                            </g>
                        </svg>
                    </x-slot>


                    <x-slot name="content">
                        @admin
                        <x-dropdown-link href="{{ route('books.create') }}">Add Book</x-dropdown-link>
                        <x-dropdown-link href="{{ route('admin.books') }}">Edit Books</x-dropdown-link>
                        <x-dropdown-link href="{{ route('categories.create') }}">Add Category</x-dropdown-link>
                        <x-dropdown-link href="{{ route('admin.categories') }}">Edit Category</x-dropdown-link>
                        <x-dropdown-link href="{{ route('coupons.create') }}">Add Coupon</x-dropdown-link>
                        <x-dropdown-link href="{{ route('admin.coupons') }}">Edit Coupon</x-dropdown-link>
                        @endadmin
                        <x-dropdown-link href="{{ route('profile.edit') }}">Profile</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <div class="static">
                    <a href="{{ route('favorites') }}"><img src="{{ asset('images/favorite.png')}}" alt="Wishlist" class="shrink-0 w-8 h-8 pt-1 mr-5" title="Wishlist"></a>
                    <span class="absolute right-32 top-12 bg-red-600 h-6 w-6 rounded-xl text-white text-center align-middle">{{ $favorites }}</span>
                </div>

                <div class="static">
                    <a href="{{ route('cart') }}"><img src="{{ asset('images/cart.png')}}" alt="Cart" class="shrink-0 w-8 h-8 pt-1 mr-4" title="Cart"></a>
                    <span class="absolute right-20 top-12 bg-red-600 h-6 w-6 rounded-xl text-white text-center align-middle">{{ $numberOfCartItems }}</span>
                </div>



                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
                <a href="#"><img src="{{ asset('images/logout.png')}}" alt="Register Logo" class="shrink-0 w-8 h-8 pt-1" title="Log out" onclick="document.querySelector('#logout-form').submit()"></a>
            </div>
        </div>
    @else
        <div class="flex pt-8">
            <div class="flex pr-4">
                <img src="{{ asset('images/register.png')}}" alt="Register Logo" class="shrink-0 w-10 h-10 pt-1 ">
                <a href="{{ route('register') }}" class="pt-3 text-xs font-bold uppercase">Register</a>
            </div>

            <div class="flex">
                <img src="{{ asset('images/login.png')}}" alt="Log In Logo" class="shrink-0 w-10 h-10">
                <a href="{{ route('login') }}" class="pt-3 text-xs font-bold uppercase">Log in</a>
            </div>
        </div>
    @endauth

    <x-dark-mode-toggle top="top-28" />
</header>
