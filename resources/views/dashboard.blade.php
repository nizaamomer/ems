@extends('layout.sidebar')
@section('title', 'داشبۆرد')
@section('content')
    <div
        class="grid lg:grid-cols-2 items-center  lg:my-16 md:grid-cols-2 grid-cols-1 flex-row text-center flex-wrap justify-between  gap-5">
        <a href="{{ route('users.index') }}"
            class="bg-indigo-700  hover:bg-indigo-800 text-lg px-3 sm:px-0   py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center">
            <i class="fa-solid fa-users sm:text-4xl text-2xl bg-indigo-500  text-gray-300 rounded-md px-4 py-3"></i>
            <div class="text-md sm:text-2xl  text-right text-gray-300 space-y-4">
                <p>
                    {{ $users }}
                </p>
                <p class="sm:text-base text-sm">
                    بەکــارهێـنەر
                </p>
            </div>
        </a>
        <a href="{{ route('material.index') }}"
            class="bg-purple-700 hover:bg-purple-800 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center">
            <i class="fa-solid fa-boxes-stacked sm:text-4xl text-2xl bg-purple-500  text-gray-300 rounded-md px-4 py-3"></i>
            <div class="text-md sm:text-2xl  text-right text-gray-300 space-y-4">
                <p>
                    {{ $materials }}
                </p>
                <p class="sm:text-base text-sm">
                    مادەی زیادکراو
                </p>
            </div>
        </a>
        <a href="{{ route('invoice.index') }}"
            class="bg-red-500 hover:bg-red-600 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center">
            <i class="fa-solid fa-file-pdf sm:text-4xl text-2xl bg-red-400  text-gray-200 rounded-md px-4 py-3"></i>
            <div class="text-md sm:text-2xl  text-right text-gray-200 space-y-4">
                <p>{{ $invoices }}</p>
                <p class="sm:text-lg text-sm">ژمارەی وەسڵەکان</p>
            </div>
        </a>
        <a href="{{ route('report.invoice') }}"
            class="bg-teal-600 hover:bg-teal-700 text-lg px-3 sm:px-0 py-6 rounded-lg text-gray-800 font-semibold shado-lg flex justify-around items-center">
            <i class="fa-solid fa-wallet sm:text-4xl text-2xl bg-teal-400  text-gray-200 rounded-md px-4 py-3"></i>
            <div class="text-md sm:text-2xl  text-right text-gray-200 space-y-4">
                <p>{{ number_format($expenseToThisMonth, 0, '.', ',') }}<span class="text-gray-800">د.ع</span></p>
                <p class="sm:text-lg text-sm">خەرجیەکانی ئەم مانگە</p>
            </div>
        </a>
    </div>
@endsection
