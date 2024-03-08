<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <title>سەیری ئیمەیڵەکەت بکە!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="dark:bg-gray-900 font-kurdish text-center bg-gray-400 h-screen overflow-auto">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-indigo-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-indigo-900 dark:border-gray-900">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-300 md:text-2xl dark:text-gray-400">
                       بڕۆ بۆ ئەپی جیمەیڵ و ئێمە لینکێکت بۆ دەنێرین لەوێوە دەتوانیت بیگۆڕیت
        
                    </h1>
                    <div class="space-y-4 md:space-y-4">
                        <img src="{{ asset('images/email.png') }}" alt="" class="mx-auto h-1/2 w-1/2 p-4">
                        <a type="submit" href="{{ route('login') }}"
                            class="w-full text-white text-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-gray-800">{{ __('Return Back To Login') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>