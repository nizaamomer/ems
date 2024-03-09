@extends('layout.sidebar')
@section('title', 'وردەکاری بەکارهێنەر')
@section('content')
    <div class="p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        داشبۆرد
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
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-400 dark:hover:text-indigo-400">بەکارهێنەران</a>
                    </div>
                </li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <p class="ml-1 text-sm font-medium text-gray-700  md:ml-2 dark:text-indigo-400 ">وردەکاری بەکارهێنەر</p>
                </div>
                </li>

            </ol>
        </nav>
        <div class="w-4/5  mx-auto my-5 flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-indigo-400">وردەکاری بەکارهێنەر</h5>
            <a href="{{ url()->previous() }}"
                class="text-sm bg-indigo-500 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-900">
                گەڕانەوە
            </a>
        </div>
        <div
            class="w-full mx-auto md:w-4/5 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-between">
                            @if ($user->image !== null)
                                <img class="w-32 h-32 rounded-lg mx-auto sm:mx-0 mb-4"
                                    src="{{ asset('user_images/' . $user->image) }}" alt="">
                            @else
                                @php

                                    function getfirst($name)
                                    {
                                        $words = explode(' ', $name);
                                        $initials = '';
                                        foreach ($words as $word) {
                                            $initials .= strtoupper(substr($word, 0, 1));
                                        }
                                        return $initials;
                                    }

                                @endphp

                                <div
                                    class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <span
                                        class="font-medium  text-xl text-gray-600 dark:text-indigo-400">{{ getfirst($user->name) }}</span>
                                </div>
                            @endif


                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center  font-bold text-gray-900 dark:text-indigo-200">
                                ناوی تەواو
                            </div>
                            <div class="inline-flex items-center w-7/12 text-right  text-gray-900 dark:text-gray-400">
                                {{ $user->name }}
                            </div>
                        </div>
                    </li>
                    <li class="pt-3 pb-4 sm:pt-4">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center font-bold text-gray-900 dark:text-indigo-200">
                                ئیمەیڵ
                            </div>
                            <div class="inline-flex items-center w-7/12  text-gray-900 dark:text-gray-400">
                                {{ $user->email }}
                            </div>
                        </div>
                    </li>
                    <li class="pt-3 pb-4 sm:pt-4">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center font-bold text-gray-900 dark:text-indigo-200">
                                پلە
                            </div>
                            <div class="inline-flex items-center w-7/12  text-gray-900 dark:text-gray-400">
                                @if ($user->Role === 'admin')
                                    ئەدمین
                                @elseif ($user->Role === 'recorder')
                                    ئیدیتەر
                                @elseif ($user->Role === 'viewer')
                                    بینەر
                                @else
                                    هیچ رۆڵێکت نیە
                                @endif

                            </div>
                        </div>
                    </li>
                    <li class="pt-3 pb-2 sm:pt-4">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center font-bold text-gray-900 dark:text-indigo-200">
                                زیادکراوە لە
                            </div>
                            <div class="inline-flex items-center w-7/12  text-gray-900 dark:text-gray-400">
                                {{ $user->created_at->diffForHumans() }} <br>
                                {{ $user->created_at }}

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
