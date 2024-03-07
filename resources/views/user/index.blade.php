@extends('layout.sidebar')
@section('title', 'بەکارهێنەران')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        @endforeach
    @endif
    @if (session('message'))
        @php
            flash()->option('position', 'top-left')->addSuccess(session('message'));
        @endphp
    @endif

    <div class="sm:flex block items-center justify-between mb-4 ">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
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
                    <p class="ml-1 text-sm font-medium text-gray-700  md:ml-2 dark:text-indigo-400 ">
                        بەکارهێنەران</p>
                </div>
                </li>

            </ol>
        </nav>
        <div class="flex items-center space-x-3 space-x-reverse my-5 sm:my-0 justify-center">

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-indigo-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <form action="{{ route('users.index') }}" method="GET" id="search-form">
                    @csrf
                    <input type="text" id="table-search" name="search" value="{{ request('search') }}"
                        class="block p-2 pl-10  text-sm text-gray-900 border border-indigo-300 rounded-lg  sm:w-80 bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-indigo-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 focus:transition focus:duration-[4000ms] focus:ease-in-out"
                        placeholder="....بگەڕێ بەدوای بەکارهێنەر">
                </form>
            </div>
            @if (auth()->user()->permissions === 'admin' || auth()->user()->permissions === 'recorder')
                <a href="{{ route('users.create') }}"
                    class="text-sm bg-indigo-600 px-4 hidden sm:block py-2 rounded-md font-semibold text-white hover:bg-indigo-700 dark:text-gray-900">
                    زیادکردنی بەکارهێنەر
                </a>
                <a href="{{ route('users.create') }}"
                    class="text-sm bg-indigo-600 sm:hidden px-4  py-2 rounded-md font-medium text-white hover:bg-indigo-700 dark:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
    <div class="relative overflow-x-scroll scroll-smooth rounded-md">
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
        @if ($users->count() > 0)
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs  text-center  text-indigo-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-indigo-400">
                    <tr class="divide-x divide-x-reverse divide-indigo-400">
                        <th scope="col" class="px-6 py-3">
                            بەکارهێنەر
                        </th>
                        <th scope="col" class="px-6 py-3">
                            پلە
                        </th>

                        <th scope="col" class="px-6 py-3">
                            درووست کراوە
                        </th>
                        @if (auth()->user()->permissions === 'admin')
                            <th scope="col" class="px-6 py-3">
                                کردارەکان
                            </th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="bg-white truncate   border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <th scope="row" class="px-6 pr-8 py-2 pt-3 flex items-center space-x-reverse space-x-3">
                                <div class="flex-shrink-0">
                                    @if ($user->image !== null)
                                        <img class="w-10 h-10 rounded-full" src="{{ asset('user_images/' . $user->image) }}"
                                            alt="{{ $user->name }}">
                                    @else
                                        <div
                                            class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-300 rounded-full dark:bg-gray-600">
                                            <span
                                                class="font-medium text-center text-normal text-gray-600 dark:text-indigo-400">{{ getFirst($user->name) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate dark:text-indigo-200">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </th>
                            <td class="px-6 py-4 capitalize text-center">

                                @if ($user->permissions === 'admin')
                                    ئەدمین
                                @elseif ($user->permissions === 'recorder')
                                    ئیدیتەر
                                @elseif ($user->permissions === 'viewer')
                                    بینەر
                                @else
                                    هیچ رۆڵێکت نیە
                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                            @if (auth()->user()->permissions === 'admin')
                                <td
                                    class="px-6 py-4 text-center flex justify-evenly space-x-reverse space-x-4 align-middle">

                                    <a href="{{ route('users.show', $user->id) }}">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="sm:w-5 sm:h-5 w-4 h-4  text-green-400 cursor-pointer hover:text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>


                                    <a href="{{ route('users.edit', $user->id) }}">
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
                                                <h1 class="text-indigo-500 text-lg py-2">سڕینەوە</h1>
                                                <p class="dark:text-gray-300">دڵنیای لە سڕینەوەی ئەم بەکارهێنەرە؟
                                                </p>
                                                <div
                                                    class="flex items-center justify-center space-x-5 space-x-reverse  py-5">
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($user->roles)
                                                            @foreach ($user->roles as $role)
                                                                <input type="hidden" name="role"
                                                                    value="{{ $role->id }}">
                                                            @endforeach
                                                        @endif
                                                        <button data-modal-hide="deletemodal" type="submit"
                                                            class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                                            بەڵێ بیسڕەوە</button>
                                                    </form>
                                                    <button data-modal-hide="deletemodal" type="submit"
                                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                        نەخێر، لابردن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            @endif

                        </tr>
                    @endforeach

                    @if ($users->total() > 10)
                        <tr class="dark:bg-gray-800 bg-white">
                            <td colspan="100%" class=" p-4">
                                <div class="w-5/6 mx-auto">
                                    {!! $users->links('myPaginate') !!}
                                </div>
                            </td>
                        </tr>
                    @endif
                @else
                    <div class="text-gray-400 dark:text-gray-400 text-center mt-24 text-lg">
                        No users available
                    </div>
                </tbody>
            </table>
        @endif
    </div>
@endsection
