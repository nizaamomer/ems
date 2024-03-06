@extends('layout.sidebar')
@section('title', 'زیادکردنی بەکارهێنەر')
@section('content')
    <div class=" sm:p-7 p-5 ">
        <div class="sm:flex block items-center justify-between mb-4 ">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1  space-x-reverse md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                            <svg class="w-3 h-3 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            داشــبۆرد
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('users.index') }}"
                                class="mr-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:mr-2 dark:text-gray-400 dark:hover:text-indigo-400">بەکارهێنەران</a>
                        </div>
                    </li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <p href="#" class="mr-1 text-sm font-medium text-gray-700  md:mr-2 dark:text-indigo-400 ">
                            زیادکردنی بەکارهێنەر</p>
                    </div>
                    </li>

                </ol>
            </nav>
        </div>
        <div class="w-4/5  mx-auto my-5 flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-indigo-400">   زیادکردنی بەکارهێنەر</h5>
            <a href="{{ url()->previous() }}"
                class="text-sm bg-indigo-500 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-900">
                گەڕانەوە
            </a>
        </div>
        <div
            class="w-full mx-auto md:w-4/5 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-1 md:gap-6">
                    <div class="relative z-0 w-full mb-1 group text-center sm:text-right">
                        <div
                            class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <label for="image" class="cursor-pointer">
                                <input type="file" name="image" id="image"
                                    class="w-full h-full absolute inset-0 opacity-0 cursor-pointer" placeholder=" "
                                    onchange="displayImage(this)" />
                                <div id="circleIcon" class="w-7 h-7 text-indigo-300 bg-center bg-cover bg-no-repeat">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-indigo-300">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </div>
                                <img id="selectedImage" class="w-full h-full absolute inset-0 object-cover" src="#"
                                    alt="Selected Image" style="display: none;" />
                            </label>
                        </div>
                        @error('image')
                            <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <script>
                            function displayImage(input) {
                                const circleIcon = document.getElementById('circleIcon');
                                const selectedImage = document.getElementById('selectedImage');

                                if (input.files.length > 0) {
                                    const file = input.files[0];
                                    const imageURL = URL.createObjectURL(file);

                                    circleIcon.style.display = 'none';
                                    selectedImage.style.display = 'block';
                                    selectedImage.src = imageURL;
                                } else {
                                    circleIcon.style.display = 'block';
                                    selectedImage.style.display = 'none';
                                }
                            }
                        </script>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="name" id="name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " value="{{ old('name') }}" />
                            <label for="name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ناوی تەواو
                                *
                            </label>
                            @error('name')
                                <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="email" id="email"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " value="{{ old('email') }}" />
                            <label for="email"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ئیمەیڵ
                                *</label>
                            @error('email')
                                <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="password" name="password" id="passsword"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " value="{{ old('password') }}" />
                            <label for="passsword"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">وشەی نهێنی
                                *
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
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">دووپاتکردنەوەی وشەی نهێنی
                                *</label>
                            @error('password_confirmation')
                                <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                      
                        <div class="relative z-0 w-full mb-6 group">

                            <label for="permissions"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">پلە</label>

                            <select d="permissions" name="permissions"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option class="bg-indigo-400" >پلە هەڵبژێرە</option>

                                <option value="admin">ئەدمین</option>
                                <option value="viewer">بینەر</option>
                                <option value="recorder">ئیدیتەر</option>

                            </select>
                            @error('permissions')
                                <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-6 mt-7 group text-right ">
                            <button type="submit"
                                class="text-black  bg-indigo-700  focus:outline-none  font-medium rounded text-sm w-full  px-5 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">زیادکردن</button>
                        </div>
                    </div>

            </form>
        </div>
    </div>
    </div>
@endsection
{{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            flash()->option('position', 'top-left')->addWarning($error);
        @endphp
    @endforeach
@endif --}}
