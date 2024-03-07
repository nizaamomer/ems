<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چوونەژوورەوە </title>
</head>

<body class="dark:bg-gray-900 bg-gray-400 h-screen overflow-auto flex justify-center items-center ">


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
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-indigo-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-indigo-900 dark:border-gray-900">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-300 md:text-2xl dark:text-gray-400">
                        Sign in to <span class="text-yellow-700">Daily</span> Supermarket.
                    </h1>
                    <form class="space-y-4 md:space-y-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-gray-300">Your
                                email</label>

                            <input id="email" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', 'nizam@gmail.com') }}" autocomplete="email"
                                placeholder="name@example.com" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-300 dark:text-gray-300">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                value="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">

                            @if (Route::has('forget.password'))
                                <a class="text-sm font-medium text-gray-300 dark:text-gray-400 hover:underline dark:text-primary-500"
                                    href="{{ route('forget.password') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                        <button type="submit"
                            class="w-full text-white text-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-gray-800">{{ __('Login') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>