@extends('layout.sidebar')
@section('title', 'پڕۆفایل')
@section('content')
    <div class="sm:flex block items-center justify-between mb-4 ">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center  space-x-1   md:space-x-3 rtl:space-x-reverse ">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                        <svg class="w-3 h-3 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        داشبۆرد
                    </a>
                </li>

                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <p class="mr-1 text-sm font-medium text-gray-700  md:mr-2 dark:text-indigo-400 ">
                        دەستکاریکردنی پڕۆفایل</p>
                </div>
                </li>

            </ol>
        </nav>
    </div>
    <div class="sm:w-3/5  mx-auto my-5 flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-indigo-400">دەستکاریکردنی پڕۆفایل</h5>
        <a href="{{ url()->previous() }}"
            class="text-sm bg-indigo-500 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-900">
            گەڕانەوە
        </a>
    </div>
    @php
        function getFirst($name)
        {
            $words = explode(' ', $name);
            $initials = '';
            foreach ($words as $word) {
                $initials .= substr($word, 0, 1);
            }
            return $initials;
        }
    @endphp
    <div
        class="w-full mx-auto sm:w-3/5 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

        <form method="post" action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="num" value="form1">
            <div
                class="  w-full pb-1 mb-8 group text-center sm:text-right border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                <div
                    class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <label for="image" class="cursor-pointer">
                        <input type="file" name="image" id="image"
                            class="w-full h-full absolute inset-0 opacity-0 cursor-pointer" onchange="displayImage(this)" />
                        <div id="circleIcon" class="w-7 h-7 text-2xl text-center text-indigo-300 bg-center bg-cover bg-no-repeat">
                            {{ getFirst(auth()->user()->name) }}
                        </div>
                        <img id="selectedImage" class="w-full h-full absolute inset-0 object-cover"
                            src="{{ asset('user_images/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                            style="{{ auth()->user()->image ? 'display: block;' : 'display: none;' }}" />
                    </label>
                </div>
                <div class="text-gray-400 text-sm mt-1">گرتە بکە بۆ نوێکردنەوەی وێنە</div>
                @error('image')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
                <script>
                    function displayImage(input) {
                        const circleIcon = document.getElementById('circleIcon');
                        const selectedImage = document.getElementById('selectedImage');
                        const noImageText = document.querySelector('.mt-1.text-red-400');
                        if (input.files.length > 0) {
                            const file = input.files[0];
                            const imageURL = URL.createObjectURL(file);
                            circleIcon.style.display = 'none';
                            selectedImage.style.display = 'block';
                            selectedImage.src = imageURL;
                            noImageText.style.display = 'none';
                        } else {
                            circleIcon.style.display = 'block';
                            selectedImage.style.display = 'none';
                            noImageText.style.display = 'block';
                        }
                    }
                </script>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="{{ auth()->user()->name }}" />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:mr-0.5 after:text-red-500">ناوی
                    تەواو
                </label>
                @error('name')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="{{ auth()->user()->email }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:mr-1 after:text-red-500">ئیمایڵ</label>
                @error('email')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-3 group text-center ">
                <button type="submit"
                    class="text-black mt-5 bg-indigo-700  focus:outline-none  font-medium rounded text-sm w-full sm:w-2/3 px-5 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">تازەکردنەوە</button>
            </div>
        </form>

    </div>
    <div
        class="w-full mt-20 mx-auto sm:w-3/5 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="post" action="{{ route('profile.update', auth()->user()->id, 2) }}">
            @csrf <input type="hidden" name="num" value="form2">
            <h1 class="text-xl text-indigo-500 mb-4 text-center font-semibold">گۆڕینی وشەی نهێنی</h1>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="currentPassword" id="currentPassword"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="" />
                <label for="currentPassword"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 rtl:peer-focus:-right-28 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:mr-0.5 after:text-red-500">
                    وشەی نهێنی ئێستا
                </label>
                @error('currentPassword')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="password" id="passsword"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                        placeholder=" " value="{{ old('password') }}" />
                    <label for="passsword"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 rtl:peer-focus:-right-28 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:mr-0.5 after:text-red-500">
                        وشەی نهێنی نوێ
                    </label>
                    @error('password')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                        placeholder=" " value="{{ old('password_confirmation') }}" />
                    <label for="password_confirmation"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 rtl:peer-focus:-right-28 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:mr-0.5 after:text-red-500">دووپاتکردنەوەی
                        وشەی نهێنی</label>
                    @error('password_confirmation')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-between">

                @if (Route::has('forget.password'))
                    <a class="text-sm font-medium text-indigo-600 dark:text-indgo-600 hover:underline dark:text-primary-500"
                        href="{{ route('forget.password') }}">
                        {{ __('وشەی نهێنیت لە بیرکردووە؟') }}
                    </a>
                @endif

            </div>
            <div class="relative z-0 w-full mb-3 group text-center ">
                <button type="submit"
                    class="text-black mt-5 bg-indigo-700  focus:outline-none  font-medium rounded text-sm w-full sm:w-2/3 px-5 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">گۆڕین</button>
            </div>
        </form>

    </div>

@endsection
