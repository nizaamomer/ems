@extends('layout.sidebar')
@section('title', 'ڕاپۆرتی ئەکتیڤیتی')
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
                    <p href="#" class="mr-1 text-sm font-medium text-gray-700   dark:text-indigo-400 ">ڕیپۆرتەکان</p>
                </div>
                </li>

            </ol>
        </nav>
        <div class="flex md:w-1/2 items-center space-x-1 space-x-reverse  sm:my-0 justify-center flex-wrap sm:flex-nowrap">
            <form action="{{ route('report.activity') }}" method="GET" id="search-form"
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

                <a href="{{ route('report.activity') }}"
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

                        <a href="{{ route('report.activity') }}"
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



            </form>
            @if (auth()->user()->permissions === 'admin' || auth()->user()->permissions === 'viewer')
                <a type="button"
                    class="block text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    href="{{ route('report.activity', ['generateActivityPdf' => true]) }}"> PDF</a>
            @endif
        </div>
    </div>
    <div class="relative overflow-x-scroll scroll-smooth rounded-md">
        @if ($activities->count() > 0)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs   text-indigo-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-indigo-400">
                    <tr class="divide-x divide-x-reverse divide-indigo-400 text-center">
                        <th scope="col" class="px-4 py-3">
                            ناوی بەکارهێنەر
                        </th>
                        <th scope="col" class="px-4 py-3">
                            بەش
                        </th>
                        <th scope="col" class="px-4 py-3">
                            کردار
                        </th>
                        <th scope="col" class="px-4 py-3">
                            ڕۆژوو بەروار
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr
                            class="bg-white truncate  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <th scope="row"
                                class="px-4 py-4 font-medium capitalize text-center text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $activity->user->name }}
                            </th>
                            <td class="px-4 py-4 text-center">
                                <span class="bg-green-300 text-green-700 p-1 rounded font-semibold">
                                    {{ $activity->subject }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ $activity->action }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                {{ $activity->created_at }}
                            </td>

                        </tr>
                    @endforeach
                @else
                    <div class="text-gray-400 dark:text-gray-400 text-center mt-24 text-lg">
                        هیچ چالەکیەک نادۆزرایەوە
                    </div>
                </tbody>
            </table>
        @endif
    </div>

@endsection
