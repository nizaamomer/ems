@extends('layout.sidebar')
@section('title', 'وردەکاری وەسڵ')
@section('content')
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
                    <svg class="w-3 h-3 text-gray-400 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('invoice.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600  dark:text-gray-400 dark:hover:text-indigo-400">
                        وەسڵەکان</a>
                </div>
            </li>
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <p href="#" class="mr-1 text-sm font-medium text-gray-700   dark:text-indigo-400 ">وردەکاری وەسڵ</p>
            </div>
            </li>
        </ol>
    </nav>
    <div class="sm:w-3/5  mx-auto my-5 flex items-center justify-between mb-4">
        <h5 class="text-xl font-semibold leading-none text-gray-900 dark:text-indigo-400">وردەکاری وەسڵ</h5>
        <a href="{{ url()->previous() }}"
            class="text-sm bg-indigo-500 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-600 dark:text-gray-900">
            گەڕانەوە
        </a>
    </div>
    <div
        class="w-full mx-auto sm:w-3/5 p-3 bg-white border border-gray-200 rounded-lg shadow sm:p-5 sm:pt-1 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <li class="py-3 sm:py-4">
                    <div class="flex justify-between items-center  flex-wrap text-md dark:text-gray-400 font-semibold">
                        <div class="space-y-2">
                            <p>ناوی بەکارهێنەر: <span class="text-indigo-500 capitalize mb-3">
                                    {{ $invoice->user->name }}</span></p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm">ژمارەی وەسڵ.: <span class="text-indigo-500">
                                    {{ $invoice->invoiceNumber }}</span></p>
                        </div>
                        {{-- <div class="text-center text-white mb-3"> {!! DNS1D::getBarcodeSVG("$invoice->code", 'C39', 1.5, 50, 'White', false) !!}</div> --}}
                    </div>
                </li>
                <li class="pt-3 sm:pt-4 text-center">
                    <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ناو
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    نرخ
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    دانە
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    گشتی
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->invoiceItems as $item)
                                <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 text-xs sm:text-sm ">
                                    <th scope="row" class="px-3 py-4 font-medium text-gray-900  dark:text-white">
                                        {{ $item->material->name }}
                                    </th>

                                    <td class="px-6 py-4">
                                        {{ number_format($item->unitPrice, 0, '.', ',') }}
                                        <span class="text-indigo-700">
                                            د.ع
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ number_format($item->subTotal, 0, '.', ',') }}
                                        <span class="text-indigo-700">
                                            د.ع
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div
                        class="flex justify-between items-center  mt-4   flex-wrap text-sm dark:text-gray-400 font-semibold">
                        <p>ڕۆژوو و بەروار: <span class="text-indigo-500"> {{ $invoice->date }}</span></p>
                        <p>نرخی گشتی: <span class="text-indigo-500">
                                {{ number_format($invoice->totalAmount, 0, '.', ',') }}</span> د.ع</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
