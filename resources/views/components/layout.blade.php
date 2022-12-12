<!doctype html>

<title>BookI</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="shortcut icon" type="image/png" href="images/logo.png">
<script>
    tailwind.config = {
        theme: {
            extend: {
                height: {
                    '100': '28rem',
                },
                boxShadow: {
                    '3xl': 'rgba(0, 0, 0, 0.35) 0px 5px 15px',
                }
            }
        }
    }

    function increaseCount(a, b) {
        let input = b.previousElementSibling;
        let value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
    }

    function decreaseCount(a, b) {
        let input = b.nextElementSibling;
        let value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
        }
    }
</script>

<style>
    #bookBorder:before{
        content: '';
        position: absolute;
        height: 80px;
        width: 80px;
        border-top: 3px solid rgb(147 197 253);
        border-left: 3px solid rgb(147 197 253);
        left: 55px;
        top: 115px;
    }

    #bookBorder:after{
        content: '';
        position: absolute;
        height: 80px;
        width: 80px;
        border-bottom: 3px solid rgb(147 197 253);
        border-right: 3px solid rgb(147 197 253);
        left: 20%;
        top: 533px;
    }

    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .custom-number-input input:focus {
        outline: none !important;
    }

    .custom-number-input button:focus {
        outline: none !important;
    }
</style>

<body class="flex flex-col min-h-screen">
    <header class="flex justify-between border-b-2 border-blue-300 pl-10 pr-5">
        <div class="pt-3">
            <a href="/">
                <img src="/images/logo.png" alt="BookI Logo" width="100" height="16">
            </a>
        </div>

        <div class="w-1/3 pt-6 w-2/4 shrink-0">
            <form>
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 rounded-3xl border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for books.." required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>

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
    </header>

    {{$slot}}

    <footer class="p-4 bg-white sm:p-6 dark:bg-gray-900 mt-auto">
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="/" class="hover:underline">BookI™</a>. All Rights Reserved.
        </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="https://www.linkedin.com/in/bogomil-dochev/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-7 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M26 25.963h-4.185v-6.55c0-1.56-.027-3.57-2.175-3.57-2.18 0-2.51 1.7-2.51 3.46v6.66h-4.182V12.495h4.012v1.84h.058c.558-1.058 1.924-2.174 3.96-2.174 4.24 0 5.022 2.79 5.022 6.417v7.386zM8.23 10.655a2.426 2.426 0 0 1 0-4.855 2.427 2.427 0 0 1 0 4.855zm-2.098 1.84h4.19v13.468h-4.19V12.495z" clip-rule="evenodd" /></svg>
                    <span class="sr-only">LinkedIn profile</span>
                </a>

                <a href="https://github.com/BogomilDochev" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                    <span class="sr-only">GitHub account</span>
                </a>
            </div>
        </div>
    </footer>

</body>
