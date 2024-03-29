<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>ووشەی نهێنی نوێ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="dark:bg-gray-900 font-kurdish bg-gray-400 h-screen overflow-auto">


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
        <div class="flex flex-col  items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-indigo-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-indigo-900 dark:border-gray-900">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-300 md:text-2xl dark:text-gray-400">
                        وشەی نهێنیت نوێ بکەوە !
                    </h1>
                    <form class="space-y-4 md:space-y-4" method="POST" action="{{ route('reset.password.post') }}">
                        @csrf
                        <input type="hidden" value="{{ $token }}" name="token">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-gray-300">
                                ئیمەیڵ</label>

                            <input id="email" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email"
                                placeholder="name@example.com" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-300 dark:text-gray-300">
                                وشەی نهێنی نوێ</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" value=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-300 dark:text-gray-300">دووبارەکردنەوەی
                                وشەی نهێنی</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••" value=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">

                            @if (Route::has('forget.password'))
                                <a class="text-sm font-medium text-gray-300 dark:text-gray-400 hover:underline dark:text-primary-500"
                                    href="{{ route('forget.password') }}">
                                    {{ __('وشەی نهێنیت بیرچووە؟') }}
                                </a>
                            @endif

                        </div>
                        <button type="submit"
                            class="w-full text-white text-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-gray-800">{{ __('تازەکردنەوە') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
