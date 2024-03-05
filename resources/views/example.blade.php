<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-200 dark:bg-gray-900 h-screen overflow-auto">
    <nav class="fixed top-0 z-50 w-full bg-gray-100 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-indigo-800 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <div>
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-500 dark:text-gray-400  sm:text-xl truncate text-sm font-semibold sm:ml-5 text-center"><span
                                class="text-indigo-600 dark:text-indigo-500">Daily</span> Supermarket.</a>
                    </div>
                    <div class="divide-x hidden sm:inline-block  divide-indigo-400 space-x-2 ml-20">
                        <div class=" dark:text-gray-500 text-gray-600 sm:inline-block  text-lg font-semibold">
                            <span id="date"></span>
                        </div>
                        <div class=" dark:text-gray-500 text-gray-600 sm:inline-block  text-lg font-semibold">
                            <span id="time" class="ml-2.5"></span>
                        </div>
                    </div>
                </div>
                <script>
                    function updateDateTime() {
                        const now = new Date();
                        document.getElementById('date').textContent = now.toLocaleDateString();
                        document.getElementById('time').textContent = now.toLocaleTimeString();
                    }
                    setInterval(updateDateTime, 1000);
                    updateDateTime();

                    function toggleFullscreen() {
                        var isFullscreen = document.fullscreenElement !== null;
                        var button = document.getElementById('toggleFullscreen');
                        if (isFullscreen) {
                            document.exitFullscreen();
                            button.innerHTML = '<i class="fas fa-maximize px-2.5 py-2.5 dark:text-gray-800 text-white text-lg"></i>';
                        } else {
                            document.documentElement.requestFullscreen();
                            button.innerHTML = '<i class="fas fa-minimize px-2.5 py-2.5 dark:text-gray-800 text-white text-lg"></i>';
                        }
                    }
                </script>
                <div class="flex items-center">
                    <div class="flex items-center mr-2 space-x-3">
                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-indigo-100 dark:hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700 rounded-lg text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button onclick="toggleFullscreen()" id="toggleFullscreen" class="bg-indigo-500 rounded-md"><i
                                class="fas fa-maximize px-2.5 py-2.5 dark:text-gray-800 text-white text-lg"></i></button>
                        <a href="{{ route('sale.index') }}" class=" bg-indigo-500 rounded-md" title="POS">
                            <i class="fa-solid fa-cart-plus px-2.5 py-2.5 dark:text-gray-800 text-white text-lg"></i>
                        </a>
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @if (auth()->user()->image)
                                    <img class="sm:w-9 sm:h-9 w-9 h-9 rounded-md"
                                        src="{{ asset('user_images/' . auth()->user()->image) }}"
                                        alt="{{ auth()->user()->name }}">
                                @else
                                    <i
                                        class="fa-regular fa-circle-user text-3xl  w-8 h-8 text-gray-700 bg-gray-100 dark:bg-gray-800 dark:text-gray-500"></i>
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-indigo-900 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-gray-300" role="none">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-100 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-100 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                @guest
                    <li>
                        <a href="{{ route('login') }}"
                            class="flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                            <i
                                class="fa-solid fa-arrow-right-to-bracket flex-shrink-0 text-md text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Login To View</span>
                        </a>
                    </li>
                @endguest
                @auth
                    @if (auth()->user()->hasPermissionTo('Dashboard'))
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="{{ Route::currentRouteName() == 'dashboard' ? 'bg-indigo-800 text-gray-300 ' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ Route::currentRouteName() == 'dashboard' ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path
                                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path
                                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Products') ||
                            auth()->user()->hasPermissionTo('Product Show') ||
                            auth()->user()->hasPermissionTo('Product Create') ||
                            auth()->user()->hasPermissionTo('Product Edit') ||
                            auth()->user()->hasPermissionTo('Product Delete') ||
                            auth()->user()->hasPermissionTo('Categories') ||
                            auth()->user()->hasPermissionTo('Category Show') ||
                            auth()->user()->hasPermissionTo('Category Create') ||
                            auth()->user()->hasPermissionTo('Category Edit') ||
                            auth()->user()->hasPermissionTo('Category Delete') ||
                            auth()->user()->hasPermissionTo('Units') ||
                            auth()->user()->hasPermissionTo('Unit Create') ||
                            auth()->user()->hasPermissionTo('Unit Edit') ||
                            auth()->user()->hasPermissionTo('Unit Delete') ||
                            auth()->user()->hasPermissionTo('Expired Products') ||
                            auth()->user()->hasPermissionTo('Expired Product Show') ||
                            auth()->user()->hasPermissionTo('Expired Product Delete') ||
                            auth()->user()->hasPermissionTo('Decreased Products') ||
                            auth()->user()->hasPermissionTo('Decreased Product Show') ||
                            auth()->user()->hasPermissionTo('Decreased Product Delete'))
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-indigo-700 dark:text-gray-400 dark:hover:bg-indigo-800"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <i
                                    class="fa-solid fa-boxes-stacked text-lg text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ Route::currentRouteName() == 'dasahboard' ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 text-right whitespace-nowrap">Products</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-example"
                                class=" {{ in_array(Route::currentRouteName(), ['category.index', 'category.show', 'category.edit', 'category.create', 'unit.index', 'unit.show', 'unit.edit', 'unit.create', 'product.index', 'product.show', 'product.edit', 'product.create', 'product.expired', 'product.decreased']) ? '' : 'hidden' }} py-2 space-y-2 text-sm ml-5">
                                @if (auth()->user()->hasPermissionTo('Products') ||
                                        auth()->user()->hasPermissionTo('Product Show') ||
                                        auth()->user()->hasPermissionTo('Product Create') ||
                                        auth()->user()->hasPermissionTo('Product Edit') ||
                                        auth()->user()->hasPermissionTo('Product Delete'))
                                    <li>
                                        <a href="{{ route('product.index') }}"
                                            class="{{ in_array(Route::currentRouteName(), ['product.index', 'product.show', 'product.edit', 'product.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                            <i
                                                class="fa-solid fa-boxes-stacked text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['product.index', 'product.show', 'product.edit', 'product.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Products</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->hasPermissionTo('Categories') ||
                                        auth()->user()->hasPermissionTo('Category Show') ||
                                        auth()->user()->hasPermissionTo('Category Create') ||
                                        auth()->user()->hasPermissionTo('Category Edit') ||
                                        auth()->user()->hasPermissionTo('Category Delete'))
                                    <li>
                                        <a href="{{ route('category.index') }}"
                                            class="{{ in_array(Route::currentRouteName(), ['category.index', 'category.show', 'category.edit', 'category.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                            <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['category.index', 'category.show', 'category.edit', 'category.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 18 18">
                                                <path
                                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                                            </svg>
                                            <span class="ml-3">Product Category</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->hasPermissionTo('Units') ||
                                        auth()->user()->hasPermissionTo('Unit Create') ||
                                        auth()->user()->hasPermissionTo('Unit Edit') ||
                                        auth()->user()->hasPermissionTo('Unit Delete'))
                                    <li>
                                        <a href="{{ route('unit.index') }}"
                                            class="{{ in_array(Route::currentRouteName(), ['unit.index', 'unit.show', 'unit.edit', 'unit.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                            <i
                                                class="fa-solid fa-folder-tree text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['unit.index', 'unit.show', 'unit.edit', 'unit.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Product Unit</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->hasPermissionTo('Expired Products') ||
                                        auth()->user()->hasPermissionTo('Expired Product Show') ||
                                        auth()->user()->hasPermissionTo('Expired Product Delete'))
                                    <li>
                                        <a href="{{ route('product.expired') }}"
                                            class="{{ Route::currentRouteName() == 'product.expired' ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                            <i
                                                class="fa-solid fa-calendar-xmark text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ Route::currentRouteName() == 'product.expired' ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Product Expired</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->hasPermissionTo('Decreased Products') ||
                                        auth()->user()->hasPermissionTo('Decreased Product Show') ||
                                        auth()->user()->hasPermissionTo('Decreased Product Delete'))
                                    <li>
                                        <a href="{{ route('product.decreased') }}"
                                            class="{{ Route::currentRouteName() == 'product.decreased' ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                            <i
                                                class="fa-solid fa-angles-down text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ Route::currentRouteName() == 'product.decreased' ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Product Decreased</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Sale Invoices') ||
                            auth()->user()->hasPermissionTo('Sale Invoice Show') ||
                            auth()->user()->hasPermissionTo('Sale Invoice Edit') ||
                            auth()->user()->hasPermissionTo('Sale Invoice Delete') ||
                            auth()->user()->hasPermissionTo('Purchase Invoices') ||
                            auth()->user()->hasPermissionTo('Purchase Invoice Show') ||
                            auth()->user()->hasPermissionTo('Purchase Invoice Edit') ||
                            auth()->user()->hasPermissionTo('Purchase Invoice Delete'))
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-indigo-700 dark:text-gray-400 dark:hover:bg-indigo-800"
                                aria-controls="invoices" data-collapse-toggle="invoices">
                                <i
                                    class="fa-solid fa-receipt text-lg text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ Route::currentRouteName() == 'dasahboard' ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 text-right whitespace-nowrap ml-4"> Invoices</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="invoices"
                                class=" {{ in_array(Route::currentRouteName(), ['buyinvoice.index', 'buyinvoice.show', 'buyinvoice.edit', 'saleinvoice.index', 'saleinvoice.show', 'saleinvoice.edit']) ? '' : 'hidden' }} py-2 space-y-2 text-sm ml-5">
                                @if (auth()->user()->hasPermissionTo('Sale Invoices') ||
                                        auth()->user()->hasPermissionTo('Sale Invoice Show') ||
                                        auth()->user()->hasPermissionTo('Sale Invoice Edit') ||
                                        auth()->user()->hasPermissionTo('Sale Invoice Delete'))
                                    <li>
                                        <a href="{{ route('saleinvoice.index') }}"
                                            class="{{ in_array(Route::currentRouteName(), ['saleinvoice.index', 'saleinvoice.show', 'saleinvoice.edit']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-1.5 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                            <i
                                                class="fa-solid fa-arrow-up-from-bracket text-lg text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['saleinvoice.index', 'saleinvoice.show', 'saleinvoice.edit']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Sale Invoices</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->hasPermissionTo('Purchase Invoices') ||
                                        auth()->user()->hasPermissionTo('Purchase Invoice Show') ||
                                        auth()->user()->hasPermissionTo('Purchase Invoice Edit') ||
                                        auth()->user()->hasPermissionTo('Purchase Invoice Delete'))
                                    <li>
                                        <a href="{{ route('buyinvoice.index') }}"
                                            class="{{ in_array(Route::currentRouteName(), ['buyinvoice.index', 'buyinvoice.show', 'buyinvoice.edit']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-1.5 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                            <i
                                                class="fa-solid fa-arrow-up-from-bracket rotate-180 text-lg text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-yellow-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['buyinvoice.index', 'buyinvoice.show', 'buyinvoice.edit']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                            <span class="ml-3">Buy Invoices</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Companies') ||
                            auth()->user()->hasPermissionTo('Company Create') ||
                            auth()->user()->hasPermissionTo('Company Show') ||
                            auth()->user()->hasPermissionTo('Company Edit') ||
                            auth()->user()->hasPermissionTo('Company Delete'))
                        <li>
                            <a href="{{ route('company.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['company.index', 'company.show', 'company.edit', 'company.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                <i
                                    class="fa-solid fa-shop flex-shrink-0 text-md text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['company.index', 'company.show', 'company.edit', 'company.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Companies</span>
                                {{-- <span
                    class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span>
                    --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Suppliers') ||
                            auth()->user()->hasPermissionTo('Supplier Create') ||
                            auth()->user()->hasPermissionTo('Supplier Show') ||
                            auth()->user()->hasPermissionTo('Supplier Edit') ||
                            auth()->user()->hasPermissionTo('Supplier Delete'))
                        <li>
                            <a href="{{ route('supplier.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['supplier.index', 'supplier.show', 'supplier.edit', 'supplier.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                <i
                                    class="fa-solid fa-truck  text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['supplier.index', 'supplier.show', 'supplier.edit', 'supplier.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Suppliers</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Expenses') ||
                            auth()->user()->hasPermissionTo('Expense Create') ||
                            auth()->user()->hasPermissionTo('Expense Edit') ||
                            auth()->user()->hasPermissionTo('Expense Delete'))
                        <li>
                            <a href="{{ route('expense.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['expense.index', 'expense.show', 'expense.edit', 'expense.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                <i
                                    class="fa-solid fa-wallet text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['expense.index', 'expense.show', 'expense.edit', 'expense.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Expenses</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Purchase'))
                        <li>
                            <a href="{{ route('buy.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['buy.index']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                <i
                                    class="fa-solid fa-cart-plus text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['buy.index']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Buy Product</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Warehouse'))
                        <li>
                            <a href="{{ route('warehouse.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['warehouse.index']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                <i
                                    class="fa-solid fa-house-laptop text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['warehouse.index']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Warehouse</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    {{-- @if (auth()->user()->hasAllPermissions(['edit articles', 'publish articles', 'unpublish articles'])))
                    
                @endif --}}
                    @if (auth()->user()->hasPermissionTo('Roles') ||
                            auth()->user()->hasPermissionTo('Role Create') ||
                            auth()->user()->hasPermissionTo('Role Edit') ||
                            auth()->user()->hasPermissionTo('Role Delete'))
                        <li>
                            <a href="{{ route('roles.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['roles.index', 'roles.edit', 'roles.create']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                <i
                                    class="fa-solid fa-gears text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['roles.index', 'roles.edit', 'roles.create']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Roles and Permissions</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Users') ||
                            auth()->user()->hasPermissionTo('User Show') ||
                            auth()->user()->hasPermissionTo('User Create') ||
                            auth()->user()->hasPermissionTo('User Edit') ||
                            auth()->user()->hasPermissionTo('User Delete'))
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['users.index', 'users.edit', 'users.create', 'users.show']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">
                                <i
                                    class="fa-solid fa-user-shield text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['users.index', 'users.edit', 'users.create', 'users.show']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Reports'))
                        <li>
                            <a href="{{ route('report.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['report.index']) ? 'bg-indigo-800 text-gray-300' : '' }} flex items-center p-2 rounded-lg dark:text-gray-400 hover:bg-indigo-700 dark:hover:bg-indigo-800 group">

                                <i
                                    class="fa-solid fa-file-csv text-xl text-gray-500 transition duration-75 group-hover:text-yellow-400 dark:text-gray-400 dark:group-hover:text-yellow-400 {{ in_array(Route::currentRouteName(), ['report.index']) ? 'text-yellow-400 dark:text-yellow-400 ' : '' }}"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Reports</span>
                                {{-- <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-indigo-800 dark:text-gray-300">Pro</span> --}}
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:mt-14 mt-16  sm:ml-64">
        @yield('content')

    </div>



    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
        //_____________________________
        document.getElementById('table-search').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                document.getElementById('search-form').submit();
            }
        });
        //________________________________________________________________
        function toggleFormVisibility(buttonId, formId) {
            const button = document.getElementById(buttonId);
            const form = document.getElementById(formId);
            button.addEventListener("click", () => {
                if (form.classList.contains("hidden")) {
                    form.classList.remove("hidden");
                } else {
                    form.classList.add("hidden");
                }
            });
        }
    </script>
</body>

</html>