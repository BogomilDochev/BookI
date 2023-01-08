<!doctype html>

<title>BookI</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="shortcut icon" type="image/png" href="images/logo.png">
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    #bookBorder:before {
        content: '';
        position: absolute;
        height: 80px;
        width: 80px;
        border-top: 3px solid rgb(147 197 253);
        border-left: 3px solid rgb(147 197 253);
        left: 55px;
        top: 115px;
    }

    #bookBorder:after {
        content: '';
        position: absolute;
        height: 80px;
        width: 80px;
        border-bottom: 3px solid rgb(147 197 253);
        border-right: 3px solid rgb(147 197 253);
        left: 18.5%;
        top: 533px;
    }
</style>


<body class="flex flex-col min-h-screen dark:bg-slate-900 dark:text-white">

{{$slot}}

<x-flash/>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
