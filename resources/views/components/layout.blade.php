<!doctype html>

<title>BookI</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="shortcut icon" type="image/png" href="images/logo.png">
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    tailwind.config = {
        theme: {
            extend: {
                height: {
                    '100': '28rem',
                },
                boxShadow: {
                    '3xl': 'rgba(0, 0, 0, 0.35) 0px 5px 15px',
                },
                left: {
                    '1/5': '20%'
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

    function currentSort() {
        let currentSort = document.getElementsByClassName("sort").getAttribute("value");
        document.getElementById("currentSort").innerHTML = currentSort;
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
        left: 18.5%;
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

    {{$slot}}

</body>
