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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->


</head>

<body class="bg-gray-900">
    {{-- sidebar --}}
    @include('components.admin.sidebar')


    {{-- content --}}
    <main class="sm:ml-64">
        <div class=" {{ request()->is('/admin') ? 'mt-14' : 'mt-0' }}">
            @yield('content')

        </div>
    </main>




</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
{{-- <script src="resources/js/modal.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}

</html>
