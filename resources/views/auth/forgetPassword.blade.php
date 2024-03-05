<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-slate-900 h-screen overflow-auto flex justify-center items-center ">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                flash()->option('position', 'top-left')->addError($error);
            @endphp
        @endforeach
    @endif
    @if (session('message'))
        @php
            flash()->option('position', 'top-left')->addSuccess(session('message'));
        @endphp
    @endif
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-indigo-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-indigo-900 dark:border-gray-900">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-300 md:text-2xl dark:text-gray-400">
                        Reset Password
                    </h1>
                    <p class="text-black text-sm">ئێمە لینکێک دەنێرین بۆ ئیمێڵەکەت، لەڕیگەی ئەو لینکەوە دەتوانیت وشەی نهێنیت بگۆڕیت</p>
                    <form class="space-y-4 md:space-y-4" method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-gray-300">ئیمێڵەکەت</label>
                            <input id="email" type="text"
                                class="bg-gray-800 border border-gray-300 text-gray-100 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email"
                                placeholder="name@example.com" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full text-white text-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-gray-800">{{ __('لینک بنێرە') }}
                        </button>
                        <div class="flex items-center justify-between">
                            @if (Route::has('login'))
                                <a class="text-sm font-medium text-gray-300 dark:text-gray-500 hover:underline dark:text-primary-500"
                                    href="{{ route('login') }}">
                                    {{ __('بگەڕێوە بۆ بەشی سەرەکی') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>