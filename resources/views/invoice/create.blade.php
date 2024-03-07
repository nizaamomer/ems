@extends('layout.sidebar')
@section('title', 'زیادردنی وەسڵ')
@section('content')
    @if (session('message'))
        @php
            flash()->addSuccess(session('message'));
        @endphp
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-1.5">
        <div class="space-y-3 ">
            <div class="flex justify-between items-center space-x-1 space-x-reverse">
                <form action="{{ route('invoice.create') }}" method="GET" id="search-form" class="w-full ">
                    @csrf
                    <label for="search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <input type="search" id="table-search" name="search" value="{{ request('search') }}" autofocus
                            class="block w-full  pr-10 text-sm text-gray-900 rounded-lg bg-gray-50 dark:bg-gray-800  dark:placeholder-gray-400 dark:text-white "
                            placeholder="بگەڕی بۆ مادە لە ڕیگەی ناو / کۆد ...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
            <div class="dark:bg-gray-800 bg-gray-100 rounded-md p-1.5">
                <div class=" h-[72vh] overflow-auto w-full border-t border-gray-500 border-dotted">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 relative">
                        <thead
                            class="text-sm capitalize text-center z-30 overflow-auto  sticky top-0 bg-gray-300 text-black dark:bg-gray-800 border-b dark:border-gray-700 dark:text-green-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ناوی مادە
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    کۆدی مادە
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="relative">
                            @if ($materials->count() > 0)
                                @foreach ($materials as $material)
                                    <form action="{{ route('cart.addToCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                                        <tr
                                            class="bg-white border-b text-center dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-right text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $material->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="bg-green-300 text-green-800 px-1 py-0.5 rounded font-medium">
                                                    {{ $material->code }}
                                                </span>

                                            </td>

                                            <td class=" cursor-pointer">
                                                <button type="submit" class="w-full p-4" title="زیادکردن">
                                                    <i
                                                        class="fa-solid fa-cart-plus dark:text-indigo-400 text-indigo-600 hover:text-indigo-700 dark:hover:text-red-400 text-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            @else
                                <tr class="">
                                    <td colspan="5">
                                        <div class="text-gray-400 mt-10 dark:text-gray-400 text-center text-sm">
                                            هیچ مادەیەک نادۆزرایەوە....
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="dark:bg-gray-800 bg-gray-100 rounded-lg">
            <div class="dark:bg-gray-800 bg-gray-100 rounded-md h-[67vh] overflow-auto ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-1 relative">
                    <thead
                        class="text-sm text-gray-700 capitalize text-center z-30 overflow-auto  sticky top-0 bg-gray-50 dark:bg-gray-800 border-b dark:border-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                ناو
                            </th>

                            <th scope="col" class="px-4 py-3">
                                بڕ (دانە)
                            </th>
                            <th scope="col" class="px-4 py-3">
                                نرخی یەک دانە
                            </th>
                            <th scope="col" class="px-4 py-3">
                                بڕی کۆتای
                            </th>
                        </tr>
                    </thead>
                    <tbody class="relative">
                        @if ($cartItems->count() > 0)
                            @foreach ($cartItems as $item)
                                <tr
                                    class="bg-white border-b text-center dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-500 dark:hover:bg-gray-800">
                                    <th scope="row"
                                        class="px-4 py-4 font-medium text-left  text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->material->name }}
                                    </th>

                                    <td class="px-4 py-4 flex justify-center items-center">
                                        <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-300 text-red-700 rounded p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 p-0.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                            </button>
                                        </form>
                                        <span>
                                            <form id="quantity-form-{{ $item->id }}" action="{{ route('cart.setQuantity', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="number" value="{{ $item->quantity }}" name="quantity" id="quantity-{{ $item->id }}" min="1" class="block pr-4 w-10 rounded p-0.5 appearance-none outline-none border-none text-sm text-gray-900 bg-transparent dark:text-white focus:outline-none" />
                                            </form>
                                        </span>
                                        <script>
                                            document.getElementById('quantity-{{ $item->id }}').addEventListener('blur', function() {
                                                document.getElementById('quantity-form-{{ $item->id }}').submit();
                                            });
                                        </script>
                                        
                                        <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-indigo-300 text-indigo-700 rounded p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 p-0.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-4 ">
                                        <form id="price-form-{{ $item->id }}" action="{{ route('cart.setPrice', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="number" value="{{ $item->unitPrice }}" name="price" id="price-{{ $item->id }}" min="1" placeholder="نرخی مادە" class="mx-auto w-20 rounded py-0.5 px-1 appearance-none text-sm text-gray-900 bg-transparent dark:text-white focus:outline-none" />د.ع
                                        </form>
                                        <script>
                                            document.getElementById('price-{{ $item->id }}').addEventListener('blur', function() {
                                                document.getElementById('price-form-{{ $item->id }}').submit();
                                            });
                                        </script>
                                    </td>
                                    

                                    <td class="px-4 py-4 flex justify-between ">
                                        {{ number_format($item->quantity * $item->unitPrice, 0, '.', ',') }}
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="sm:w-5 sm:h-5 w-4 h-4 text-red-500 cursor-pointer hover:text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>
                                <div
                                    class="text-gray-400 mt-10 dark:text-gray-400 text-center absolute top-36 left-1/2 transform -translate-x-1/2 text-sm">
                                    هیچ مادەیەک زیادنەکراوە
                                </div>
                            </td>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class=" pt-5 text-center">
                <form action="{{ route('cart.addInvoice') }}"
                    class="grid md:grid-cols-2 grid-cols-1 mb-5 md:mb-0 items-center justify-center space-x-4 space-x-reverse flex-wrap"
                    method="POST">
                    @csrf

                    <div class="px-4 text-right">

                        <div class="space-y-1 mb-2">
                            <h1 class="dark:text-gray-400 text-base ">نرخی گشتی:
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    @php
                                        $totalAmount += $item->quantity * $item->unitPrice;
                                    @endphp
                                @endforeach
                                <span>

                                </span>
                                <span class="text-indigo-700">
                                    {{ number_format($totalAmount, 0, '.', ',') }}

                                </span>
                                د.ع
                            </h1>
                            <button type="submit"
                                class="py-2.5 w-full text-sm font-medium whitespace-nowrap text-white focus:outline-none  rounded-lg dark:bg-indigo-800 bg-indigo-800 dark:text-white ">زیادکردنی
                                وەسڵ</button>
                        </div>
                    </div>
                    <div class=" px-4">
                        <label for="invoiceNumber"
                            class="block  text-sm font-medium text-gray-900 dark:text-gray-400 after:content-['(ئەگەرهەبوو)'] after:ml-1 after:text-gray-500">
                            ژمارەی وەسڵ </label>
                        <input type="number" id="invoiceNumber" name="invoiceNumber"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="0">
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
