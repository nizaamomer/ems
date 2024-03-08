<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چوونەژوورەوە </title>
</head>

<body class="bg-gray-900  font-kurdish  h-screen overflow-auto flex justify-center items-center ">


    @if ($errors->any())
        @foreach ($errors->all() as $error)
        @endforeach
    @endif
    @if (session('message'))
        @php
            flash()->option('position', 'top-left')->addSuccess(session('message'));
        @endphp
    @endif

    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 w-screen">

            <div class="w-full bg-indigo-800 rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0  border-gray-900">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-gray-400">
                        سیستمی بەڕێوەبردنی
                        <span class="text-indigo-600 "></span>
                        <span class="text-yellow-700">خەرجی</span>
                    </h1>
                    <form class="space-y-4 md:space-y-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-400 ">
                                ئیمەیڵ</label>

                            <input id="email" type="text"
                                class=" border  sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-900 border-gray-600 placeholder-gray-400 text-white focus:ring-indigo-500 focus:border-indigo-500 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', 'nizam@gmail.com') }}" autocomplete="email"
                                placeholder="name@example.com" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-300 ">وشەی
                                نهێنی</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                value="password"
                                class=" border  sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-900 border-gray-600 placeholder-gray-400 text-white focus:ring-indigo-500 focus:border-indigo-500">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">

                            @if (Route::has('forget.password'))
                                <a class="text-sm font-medium  text-gray-400 hover:underline text-primary-500"
                                    href="{{ route('forget.password') }}">
                                    {{ __('وشەی نهێنیت بیرچووە؟') }}
                                </a>
                            @endif
                        </div>
                        <button type="submit"
                            class="w-full text-white text-lg  focus:ring-4 focus:outline-none  font-medium rounded-lg  px-5 py-2.5 text-center bg-yellow-700 hover:bg-yellow-800 focus:ring-gray-800">{{ __('بچۆ ژوورەوە') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
