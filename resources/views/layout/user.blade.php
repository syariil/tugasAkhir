<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/image/logo/logo.png') }}">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->

</head>

<body class="bg-gray-900">
    <nav
        class="bg-gray-900 border-gray-400 rounded-b-2xl w-full border-b-1  shadow-xl shadow-gray-800/50 rounded-xl {{ request()->is('register') ? '' : 'fixed z-[9999px]' }}">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-1 rtl:space-x-reverse">
                <img src="{{ asset('storage/image/logo.png') }}" class="md:h-8 h-6 rounded-full" alt="Kabaena Logo" />
                <span
                    class="self-center md:text-3xl text-[24px] font-extrabold whitespace-nowrap text-white font-kodeMono uppercase tracking-tighter">
                    kabaena<span class="text-red-600 font-kodeMono">CUP</span></span>
                </span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="md:hidden inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg  focus:outline-none focus:ring-2  text-gray-400 hover:bg-red-700 focus:ring-red-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <x-uiw-menu class="w-5 text-gray-400" />
            </button>
            <div class="md:block w-full hidden md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-row  p-0 mt-0  rounded-lg space-x-0 md:space-x-8">
                    <li>
                        <a href="{{ url('/') }}"
                            class="block py-2 px-2 md:px-3   rounded  md:p-0 hover:text-red-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:underline hover:text-[16px] md:hover:text-[18px] {{ request()->is('/') ? 'text-red-600 text-[16px] md:text-[18px] underline -translate-y-1 scale-110' : 'text-white text-[14px] md:text-[16px]' }}"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('/schedule') }}"
                            class="block py-2 px-2 md:px-3  rounded md:p-0  hover:text-red-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:underline hover:text-[16px] md:hover:text-[18px] {{ request()->is('schedule') ? 'text-red-600 text-[16px] md:text-[18px] underline -translate-y-1 scale-110' : 'text-white text-[14px] md:text-[16px]' }}">Schedule</a>
                    </li>
                    <li>
                        <a href=" {{ url('/register') }} "
                            class="block py-2 px-2 md:px-3  rounded md:p-0 text-[14px] hover:text-red-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:underline hover:text-[16px] md:hover:text-[18px] {{ request()->is('register') ? 'text-red-600 text-[16px] md:text-[18px] underline -translate-y-1 scale-110' : 'text-white text-[14px] md:text-[16px]' }} ">Registration</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    {{-- content --}}
    <main class="w-full  p-2">

        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="rounded-lg shadow bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="{{ url('/') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('storage/image/logo.png') }}" class="h-8 rounded-full" alt="kabaena cup Logo" />
                    <span
                        class="self-center md:text-2xl text-xl font-extrabold whitespace-nowrap text-white font-kodeMono uppercase tracking-tighter">
                        kabaena<span class="text-red-600 font-kodeMono">CUP</span></span>

                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="{{ route('about.us') }}" class="hover:underline hover:text-white me-4 md:me-6">About
                            Us</a>
                    </li>
                    <li>
                        <a href="{{ route('privacy.policy') }}"
                            class="hover:underline hover:text-white me-4 md:me-6">Privacy
                            Policy</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                        href="{{ route('home') }}" class="hover:underline">Kabaena Cup™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="https://www.youtube.com/@kabaenacupmlbb888"
                        class="text-gray-500 hover:text-red-600 dark:hover:text-white">
                        <x-uni-youtube-o class="h-6 w-6" />
                        <span class="sr-only">Youtube Channel</span>
                    </a>
                    <a href="https://www.instagram.com/kabaena_cup"
                        class="text-gray-500 hover:text-red-500 dark:hover:text-white ms-5">
                        <x-uni-instagram-o class="h-6 w-6" />
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="#" target="_blank"
                        class="text-gray-500 hover:text-blue-600 dark:hover:text-white ms-5">
                        <x-uni-discord-o class="h-6 w-6" />
                        <span class="sr-only">Discord community</span>
                    </a>

                </div>
            </div>
        </div>
    </footer>

</body>
<script src=""></script>

</html>
