@extends('layout.sidebar')
@section('title', 'وەسڵەکان')
@section('content')
    @if (session('message'))
        @php
            flash()->addSuccess(session('message'));
        @endphp
    @endif
    <div class="sm:flex block items-center justify-between mb-4 ">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center ">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium ml-1 text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                        <svg class="w-3 h-3 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        داشبۆرد
                    </a>
                </li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <p href="#" class="mr-1 text-sm font-medium text-gray-700   dark:text-indigo-400 ">وەسڵەکان</p>
                </div>
                </li>

            </ol>
        </nav>
        <div
            class="flex items-center space-x-1 space-x-reverse  sm:my-0 justify-center flex-wrap sm:flex-nowrap mt-4 sm:mt-0">
            <form action="{{ route('invoice.index') }}" method="GET" id="search-form"
                class=" w-full px-2 space-x-2 space-x-reverse text-center flex justify-center items-center mb-2 sm:mb-0">
                @csrf
                <select id="user_id" name="user_id" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-indigo-500  block w-full p-2 dark:bg-gray-700 dark:border-gray-800 dark:placeholder-gray-400 font-semibold dark:text-indigo-300 ">
                    <option class="dark:bg-indigo-400" value="">بەکارهێنەر دیاری بکە</option>
                    @foreach ($users as $user)
                        <option class="bg-indigo-400" value="{{ $user->id }}"
                            {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <a href="{{ route('invoice.index') }}"
                    class="text-sm text-center bg-indigo-600 px-2.5 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-800">
                    Reset
                </a>
                <button data-popover-target="popover-click" data-popover-trigger="click" type="button"
                    class="text-white bg-indigo-700 hover:bg-indigo-800  focus:outline-none  font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                </button>
                <div data-popover id="popover-click"
                    class="absolute z-10 invisible inline-block w-34 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class=" w-full px-2 py-2  text-center ">
                        <select name="date_range" size="5" onchange="this.form.submit()"
                            class="dark:bg-gray-800 w-full text-center focus:outline-none  outline-none border-0 space-y-2 h-40  ">
                            <option class="checked:bg-indigo-500 checked:text-white font-semibold rounded " value="today"
                                @selected(request('date_range') === 'today')>
                                ئەمڕۆ</option>
                            <option class="checked:bg-indigo-500 checked:text-white font-semibold rounded "
                                value="this_week" @selected(request('date_range') === 'this_week')>
                                ئەم هەفتە</option>
                            <option class="checked:bg-indigo-500 checked:text-white font-semibold rounded "
                                value="last_week" @selected(request('date_range') === 'last_week')>
                                کۆتا هەفتە</option>
                            <option class="checked:bg-indigo-500 checked:text-white font-semibold rounded "
                                value="this_month" @selected(request('date_range') === 'this_month')>
                                ئەم مانگە</option>
                            <option class="checked:bg-indigo-500 checked:text-white font-semibold rounded "
                                value="last_month" @selected(request('date_range') === 'last_month')>
                                کۆتە مانگ</option>
                        </select>
                        <button id="showrange" type="button"
                            class="checked:bg-indigo-500 mb-3 mt-4 checked:text-white font-semibold inline-block rounded">
                            دیاریکردن بە داستی
                        </button> <br>

                        <a href="{{ route('invoice.index') }}"
                            class="bg-gray-300 text-black text-center px-4 py-1 rounded cursor-pointer">
                            Reset
                        </a>

                    </div>

                    <div id="formrange"
                        class="absolute top-40 left-32 z-10 hidden  w-34 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm  dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                        <div class=" w-full px-2 py-2  text-center space-y-4 ">

                            <div>

                                <input type="date" name="custom_start_date"
                                    class="bg-gray-500 rounded text-gray-300 p-1">
                            </div>
                            <div>
                                <input type="date" name="custom_end_date" class="bg-gray-500 rounded text-gray-300 p-1">
                            </div>
                            <button type="submit" class="bg-indigo-600 text-white rounded px-2 py-1 ">بگەڕێ</button>
                        </div>
                    </div>
                    <script>
                        const button = document.getElementById('showrange');
                        const form = document.getElementById('formrange');
                        button.addEventListener("click", () => {
                            if (form.classList.contains("hidden")) {
                                form.classList.remove("hidden");
                            } else {
                                form.classList.add("hidden");
                            }
                        });
                    </script>

                    <div data-popper-arrow></div>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-indigo-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>

                        <input type="text" id="table-search" form="search-form" name="search"
                            value="{{ request('search') }}"
                            class="block p-2 pl-10 text-sm w-full text-gray-900 border border-indigo-300 rounded-lg sm:w-80 bg-gray-50   dark:bg-gray-700 dark:border-indigo-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:"
                            placeholder="بگەڕی بۆ وەسڵ لەڕێگەی ژمارەی وەسڵەکەوە....">
                    </div>

                </div>
                @if (auth()->user()->Role === 'admin' || auth()->user()->Role === 'recorder')
                    <a href="{{ route('invoice.create') }}"
                        class="bg-green-500 hidden sm:block text-black text-center px-4 py-1.5 w-full rounded cursor-pointer">
                        زیادکردنی وەسڵ
                    </a>
                    <a href="{{ route('invoice.create') }}"
                        class="text-sm bg-green-600 sm:hidden px-4  py-2 rounded-md font-medium text-white hover:bg-green-700 dark:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                @endif

            </form>
        </div>
    </div>
    <div class="relative overflow-x-scroll scroll-smooth rounded-md">
        @if ($invoices->count() > 0)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs   text-indigo-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-indigo-400">
                    <tr class="divide-x divide-x-reverse divide-indigo-400 text-center">
                        <th scope="col" class="px-4 py-3">
                            ناوی بەکارهێنەر
                        </th>

                        <th scope="col" class="px-4 py-3">
                            ژمارەی وەسڵ
                        </th>
                        <th scope="col" class="px-4 py-3">
                            بڕی پارە
                        </th>
                        <th scope="col" class="px-4 py-3">
                            ڕۆژوو بەروار
                        </th>

                        <th scope="col" class="px-4 py-3">
                            ژمارەی مادەکان
                        </th>
                        @if (auth()->user()->Role === 'admin')
                            <th scope="col" class="px-4 py-3">
                                کردارەکان
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr
                            class="bg-white truncate  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <th scope="row"
                                class="px-4 py-4 font-medium capitalize text-center text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $invoice->user->name }}
                            </th>
                            <td class="px-4 py-4 text-center">
                                <span class="bg-green-300 text-green-700 p-1 rounded font-semibold">
                                    {{ $invoice->invoiceNumber }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ number_format($invoice->totalAmount, 0, '.', ',') }} <span class="text-indigo-500">
                                    د.ع
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ $invoice->date }}
                            </td>
                            <td class="px-4 py-4 space-x-1 space-x-reverse text-center">
                                <span class="bg-indigo-300 text-indigo-700 p-1.5 rounded font-semibold">
                                    {{ $invoice->invoiceItems->count() }}
                                </span>
                            </td>

                            @if (auth()->user()->Role === 'admin')
                                <td
                                    class="px-4 py-4 text-center flex justify-evenly space-x-4 space-x-reverse align-middle">

                                    <a href="{{ route('invoice.show', $invoice->id) }}">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="sm:w-5 sm:h-5  w-4 h-4  text-green-400 cursor-pointer hover:text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('invoice.edit', $invoice->id) }}">
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
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full pr-8 sm:pr-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-md max-h-full">
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
                                                <p class="dark:text-gray-300">دڵنیای ئەتەوێ ئەم وەسڵە بسڕیەوە؟
                                                </p>
                                                <div
                                                    class="flex items-center justify-center space-x-5 space-x-reverse  py-5">
                                                    <form action="{{ route('invoice.destroy', $invoice->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="deletemodal" type="submit"
                                                            class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                                            بەڵێ بسڕەوە</button>
                                                    </form>
                                                    <button data-modal-hide="deletemodal" type="submit"
                                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                        نەخێر، لابردن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <div class="text-gray-400 dark:text-gray-400 text-center mt-24 text-lg">
                        هیچ وەسڵێک نەدۆزرایەوە
                    </div>
                </tbody>
            </table>
        @endif
    </div>

@endsection
