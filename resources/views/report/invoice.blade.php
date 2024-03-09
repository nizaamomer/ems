@extends('layout.sidebar')
@section('title', 'ڕاپۆرتی وەسڵەکان')
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
                    <p href="#" class="mr-1 text-sm font-medium text-gray-700   dark:text-indigo-400 ">ڕاپۆرتی
                        وەسڵەکان</p>
                </div>
                </li>

            </ol>
        </nav>
        <div class="flex items-center space-x-1 space-x-reverse  sm:my-0 justify-center flex-wrap sm:flex-nowrap">
            <form action="{{ route('report.invoice') }}" method="GET" id="search-form"
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

                <a href="{{ route('report.invoice') }}"
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

                        <a href="{{ route('report.invoice') }}"
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
                            class="block p-2 pl-10 text-sm text-gray-900 border border-indigo-300 rounded-lg sm:w-80 bg-gray-50   dark:bg-gray-700 dark:border-indigo-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:"
                            placeholder="بگەڕی بۆ وەسڵ لەڕێگەی ژمارەی وەسڵەکەوە....">
                    </div>
                </div>

            </form>
            @if (auth()->user()->Role === 'admin' || auth()->user()->Role === 'viewer')
                <!-- Modal toggle -->
                <button data-modal-target="invoices" data-modal-toggle="invoices"
                    class="block text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="button">
                    PDF
                </button>

                <!-- Main modal -->
                <div id="invoices" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <form action="{{ route('report.invoice.post') }}" method="POST">
                            @csrf

                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        بینینی ڕاپۆرت
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="invoices">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <p class="text-base leading-relaxed text-gray-800 dark:text-gray-300">
                                        هەرتێبینیەک داتەوێ لەسەر پەڕەکە دەربکەوێ لێرەدا بینووسە!
                                    </p>

                                    <textarea id="message" rows="4" name="message"
                                        class="block p-2.5 w-full text-sm text-gray-900 dark:focus:bg-gray-800 focus:bg-gray-200 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="لێرە بنووسە...."></textarea>
                                    <input type="hidden" value="1" name="print">
                                    <input type="hidden" name="search" id="search_hidden"
                                        value="{{ request('search') }}">
                                    <input type="hidden" name="user_id" id="user_id_hidden"
                                        value="{{ request('user_id') }}">
                                    <input type="hidden" name="date_range" id="date_range_hidden"
                                        value="{{ request('date_range') }}">
                                    <input type="hidden" name="custom_start_date" id="custom_start_date_hidden"
                                        value="{{ request('custom_start_date') }}">
                                    <input type="hidden" name="custom_end_date" id="custom_end_date_hidden"
                                        value="{{ request('custom_end_date') }}">
                                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">وردەکاریەکان</h3>
                                    <ul
                                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li
                                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="vue-checkbox-list" type="checkbox" value="1"
                                                    name="withItems"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="vue-checkbox-list"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    پیشاندانی مادەکان لەگەڵ وەسڵەکادا</label>
                                            </div>
                                        </li>
                                        <li
                                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="react-checkbox-list" type="checkbox" value="1"
                                                    name="showNote"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="react-checkbox-list"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">پیشاندانی
                                                    تێبینی</label>
                                            </div>
                                        </li>

                                    </ul>


                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="invoices" type="submit"
                                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-800 dark:focus:ring-indigo-800">داگرتن
                                        بە PDF</button>
                                    <button data-modal-hide="invoices" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">لابردن</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
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
                        @if (auth()->user()->Role === 'admin' || auth()->user()->Role === 'viewer')
                            <th scope="col" class="px-4 py-3">
                                کردارەکان
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $report)
                        <tr
                            class="bg-white truncate  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <th scope="row"
                                class="px-4 py-4 font-medium capitalize text-center text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $report->user->name }}
                            </th>
                            <td class="px-4 py-4 text-center">
                                <span class="bg-green-300 text-green-700 p-1 rounded font-semibold">
                                    {{ $report->invoiceNumber }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ number_format($report->totalAmount, 0, '.', ',') }} <span class="text-indigo-500">
                                    د.ع
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ $report->date }}
                            </td>
                            <td class="px-4 py-4 space-x-1 space-x-reverse text-center">
                                <span class="bg-indigo-300 text-indigo-700 p-1.5 rounded font-semibold">
                                    {{ $report->invoiceItems->count() }}
                                </span>
                            </td>

                            @if (auth()->user()->Role === 'admin' || auth()->user()->Role === 'viewer')
                                <td
                                    class="px-4 py-4 text-center flex justify-evenly space-x-4 space-x-reverse align-middle">

                                    <a href="{{ route('invoice.show', $report->id) }}">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="sm:w-5 sm:h-5  w-4 h-4  text-green-400 cursor-pointer hover:text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>




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
