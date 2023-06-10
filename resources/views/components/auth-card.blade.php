<div class=" p-5">
    <a class="flex pl-2 pt-1 font-semibold dark:text-white" href="javascript: history.back()"><img src="{{ asset('images/back_arrow.png')}}" alt="Back arrow icon" class="shrink-0 h-8 w-8 border-2 border-blue-700 rounded-full mr-2 -mt-1">Back</a>
</div>
<div class=" flex flex-col sm:justify-center items-center mt-16 sm:pt-0 ">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-blue-900 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
