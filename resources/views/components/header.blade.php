<header class="flex justify-between border-b-2 border-blue-300 pl-10 pr-5">
    <div class="pt-3">
        <a href="/">
            <img src="/images/logo.png" alt="BookI Logo" width="100" height="16">
        </a>
    </div>

    <div class="w-1/3 pt-6 w-2/4 shrink-0">
        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 rounded-3xl border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for books.." required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2">Search</button>
            </div>
        </form>
    </div>

    @auth
        <div class="flex pt-8">
            <div class="flex pr-4">
                <a href="#" class="pt-2 pr-2 text-xs font-bold uppercase" onclick="document.querySelector('#logout-form').submit()">Log Out</a>
                <form id="logout-form" method="POST" action="/logout" class="hidden">
                    @csrf
                </form>
                <img src="/images/logout.png" alt="Register Logo" class="shrink-0 w-8 h-8 pt-1 ">
            </div>
        </div>
    @else
        <div class="flex pt-8">
            <div class="flex pr-4">
                <img src="/images/register.png" alt="Register Logo" class="shrink-0 w-10 h-10 pt-1 ">
                <a href="/register" class="pt-3 text-xs font-bold uppercase">Register</a>
            </div>

            <div class="flex">
                <img src="/images/login.png" alt="Log In Logo" class="shrink-0 w-10 h-10">
                <a href="/login" class="pt-3 text-xs font-bold uppercase">Log in</a>
            </div>
        </div>
    @endauth

</header>
