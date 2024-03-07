@extends('layout.sidebar')
@section('title', 'دەستکاریکردنی بەکارهێنەر')
@section('content')
    <div class="sm:flex block items-center justify-between mb-4 ">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 space-x-reverse md:space-x-3">
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
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                        دەستکاریکردنی بەکارهێنەر</p>
                </div>
                </li>

            </ol>
        </nav>
    </div>
    <div class="sm:w-3/5  mx-auto my-5 flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-indigo-400">دەستکاریکردنی بەکارهێنەر</h5>
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

        <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
                class="  w-full pb-1 mb-8 group text-center sm:text-right border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                <div
                    class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <label for="image" class="cursor-pointer">
                        <input type="file" name="image" id="image"
                            class="w-full h-full absolute inset-0 opacity-0 cursor-pointer" onchange="displayImage(this)" />
                        <div id="circleIcon"
                            class="w-7 h-7 text-center text-xl text-indigo-300 bg-center bg-cover bg-no-repeat">
                            {{ getFirst($user->name) }}
                        </div>
                        <img id="selectedImage" class="w-full h-full absolute inset-0 object-cover"
                            src="{{ asset('user_images/' . $user->image) }}" alt="Selected Image"
                            style="{{ $user->image ? 'display: block;' : 'display: none;' }}" />
                    </label>
                </div>
                <div class="text-gray-400 text-sm mt-1">گرتە بکە بۆ تازەکردنەوەی وێنەکە</div>
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
                    placeholder=" " value="{{ $user->name }}" />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ناوی
                    تەواو
                    *
                </label>
                @error('name')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="{{ $user->email }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ئیمەیڵ
                    *</label>
                @error('email')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">پلە
                    هەڵبژێرە</label>
                <select id="permissions" name="permissions"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option class="bg-indigo-400">پلە هەڵبژێرە</option>

                    <option @selected($user->permissions == 'admin') value="admin">ئەدمین</option>
                    <option @selected($user->permissions == 'viewer') value="viewer">بینەر</option>
                    <option @selected($user->permissions == 'recorder') value="recorder">ئیدیتەر</option>

                </select>
                @error('permissions')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-3 group text-center ">
                <button type="submit"
                    class="dark:text-black text-white mt-5 bg-indigo-700  focus:outline-none  font-medium rounded text-sm w-full sm:w-2/3 px-5 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">تازەکردنەوەی
                    بەکارهێنەر</button>
            </div>
        </form>
    </div>

@endsection
