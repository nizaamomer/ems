@extends('layout.sidebar')
@section('title', 'زیادکردنی مادە')
@section('content')

    <div class="sm:flex block items-center justify-between mb-4 lg:w-8/12 mx-auto">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center ">
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
                        <a href="{{ route('material.index') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600  dark:text-gray-400 dark:hover:text-indigo-400">مادەکان</a>
                    </div>
                </li>
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <p href="#" class="text-sm font-medium text-gray-700   dark:text-indigo-400 ">
                        زیادکردنی مادە</p>
                </li>
              
            </ol>
        </nav>
    </div>
    <div class="lg:w-8/12  mx-auto my-5 flex items-center justify-between mb-4">
        <h5 class="text-xl font-semibold leading-none text-gray-900 dark:text-indigo-400"> زیادکردنی مادە</h5>
        <a href="{{ url()->previous() }}"
            class="text-sm bg-indigo-500 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-900">
            گەڕانەوە
        </a>
    </div>
    <div
        class="w-full mx-auto lg:w-8/12 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

        <form method="post" action="{{ route('material.store') }}">
            @csrf

            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="{{ old('name') }}" />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:ml-0.5 after:text-red-500 ">ناوی
                    مادە
                </label>
                @error('name')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="code" id="code"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                    placeholder=" " value="{{ old('code') }}" />
                <label for="code"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:right-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 after:content-['*'] after:ml-0.5 after:text-red-500">کۆدی
                    مادە</label>
                @error('code')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>



            <div class="text-right">

                <button type="submit"
                    class="text-white dark:text-black mt-5 bg-indigo-700 mx-auto  focus:outline-none  font-medium rounded text-sm w-full sm:w-3/5 px-5 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">زیادکردنی
                    مادە</button>

            </div>
        </form>

    </div>

@endsection
