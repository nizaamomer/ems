@extends('layout.sidebar')
@section('title', 'مادەکان')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        @endforeach
    @endif
    @if (session('message'))
        @php
            flash()->addSuccess(session('message'));
        @endphp
    @endif

    <div class="sm:flex block items-center justify-between mb-4 lg:w-9/12 mx-auto">
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
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <p href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2 dark:text-indigo-400 ">
                        مادەکان</p>
                </div>
                </li>

            </ol>
        </nav>
        <div class="flex items-center space-x-3 space-x-reverse my-5 sm:my-0 justify-center relative">


            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-indigo-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>

                <form action="{{ route('material.index') }}" method="GET" id="search-form">
                    @csrf
                    <input type="text" id="table-search" name="search" value="{{ request('search') }}"
                        class="block p-2 pl-10 text-sm text-gray-900 border border-indigo-300 rounded-lg sm:w-80 bg-gray-50  focus:border-indigo-500 dark:bg-gray-700 dark:border-indigo-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="بگەڕێ بە دوای مادە">
                </form>
            </div>
            @if (auth()->user()->permissions === 'admin' || auth()->user()->permissions === 'recorder')
                <a href="{{ route('material.create') }}"
                    class="text-sm bg-indigo-600 px-4 hidden sm:block py-2 rounded-md font-semibold text-white hover:bg-indigo-700 dark:text-gray-900">
                    زیادکردنی مادە
                </a>
                <a href="{{ route('material.create') }}"
                    class="text-sm bg-indigo-600 sm:hidden px-4  py-2 rounded-md font-medium text-white hover:bg-indigo-700 dark:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
    <div class="relative overflow-x-scroll scroll-smooth rounded-md mx-auto lg:w-9/12">
        @if ($materials->count() > 0)
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs   text-indigo-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-indigo-400">
                    <tr class="divide-x divide-x-reverse divide-indigo-400 text-center">
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ناوی مادە
                        </th>
                        <th scope="col" class="px-6 py-3">
                            کۆی مادە
                        </th>
                        @if (auth()->user()->permissions === 'admin')
                            <th scope="col" class="px-6 py-3">
                                کردارەکان
                            </th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr
                            class="bg-white truncate  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $material->name }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-red-300 text-red-700 p-1 rounded font-semibold">
                                    {{ $material->code }}
                                </span>
                            </td>
                            @if (auth()->user()->permissions === 'admin')
                                <td class="px-6 py-4 text-right flex justify-evenly space-x-reverse space-x-4 align-middle">


                                    <a href="{{ route('material.edit', $material->id) }}">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="sm:w-5 sm:h-5 w-4 h-4 text-indigo-500 cursor-pointer hover:text-indigo-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <button data-modal-target="deletemodal" data-modal-toggle="deletemodal">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="sm:w-5 sm:h-5 w-4 h-4 text-red-500 cursor-pointer hover:text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    <!-- Main modal -->
                                    <div id="deletemodal" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full pl-8 sm:pl-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative sw-full max-w-screen-md max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative bg-white rounded-lg shadow dark:bg-gray-800 p-5 text-center items-center">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="sm:w-20 sm:h-20 w-14 h-14 text-red-500 mx-auto hover:text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <h1 class="text-indigo-500 text-lg py-2">سڕینەوە!</h1>
                                                <p class="dark:text-gray-300">دڵنیای لە سڕینەوەی ئەم مادەیە ؟
                                                </p>
                                                <div
                                                    class="flex items-center justify-center space-x-5 space-x-reverse  py-5">

                                                    <form action="{{ route('material.destroy', $material->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button data-modal-hide="deletemodal" type="submit"
                                                            class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-right dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                                            بەڵێ، بسڕەوە</button>
                                                    </form>
                                                    <button data-modal-hide="deletemodal" type="submit"
                                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-right dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                        نەخێر، لابردن</button>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            @endif

                        </tr>
                    @endforeach
                    @if ($materials->total() > 10)
                        <tr class="dark:bg-gray-800 bg-white">
                            <td colspan="100%" class=" p-4">
                                <div class="w-5/6 mx-auto " dir="ltr">

                                    {{-- {!! $materials->links('myPaginate') !!} --}}
                                    {!! $materials->links('pagination.myPaginate') !!}

                                </div>
                            </td>
                        </tr>
                    @endif
                @else
                    <div class="text-gray-400 dark:text-gray-400 text-center mt-24 text-lg">
                        هیچ مادەیەک نەدۆزرایەوە
                    </div>

                </tbody>

            </table>
        @endif
        <div class="clear-both ">
        </div>
    </div>

@endsection
