<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/image/logo.png') }}">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="{{ mix('resources/js/app.js') }}"></script> --}}
    <meta name="app-url" content="{{ config('app.url') }}">
    @php
        $isProduction = app()->environment('production');
        $manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');
    @endphp

    @if ($isProduction && file_exists($manifestPath))
        @php
            $manifest = json_decode(file_get_contents($manifestPath), true);
        @endphp
        <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">
        <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
    @else
        @viteReactRefresh
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    @endif
    <!-- Styles -->


</head>

<body class="bg-gray-900">
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 ">
        <div class="flex-col gap-4 w-full flex items-center justify-center">
            <div
                class="w-28 h-28 border-8 text-red-600 text-4xl animate-spin border-gray-300 flex items-center justify-center border-t-red-600 rounded-full">
                <img src="{{ asset('storage/image/logo/logo.png') }}" class="w-12 h-12 rounded-full animate-ping"
                    alt="Kabaena Logo" />
            </div>
        </div>
    </div>
    {{-- sidebar --}}
    @include('components.admin.sidebar')


    {{-- content --}}
    <main class="sm:ml-64">
        <div class=" {{ request()->is('/admin') ? 'mt-14' : 'mt-16 md:mt-0' }}">
            <div
                class="w-[calc(100%-256px+256px)] h-screen items-end flex justify-center bg-[url('/storage/image/logo.png')] bg-no-repeat bg-fixed bg-center bg-opacity-5 opacity-10 bg-cover fixed z-[-10]">
            </div>
            @yield('content')

        </div>
    </main>




</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
{{-- <script src="resources/js/modal.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}

</html>
