<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{ url('storage/image/logo.png') }}">
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
    <div
        class="w-[calc(100%-256px+256px)] h-screen items-end flex justify-center bg-[url('/storage/image/logo.png')] bg-no-repeat bg-fixed bg-center bg-opacity-5 opacity-10 bg-cover fixed z-[-10]">
    </div>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen h-auto ">
            <a href="{{ url('/') }}"
                class="flex items-center mb-6 text-4xl font-bold text-white font-kodeMono uppercase">
                <img class="w-12 h-12 mr-2 rounded-full" src="{{ asset('storage/image/logo/logo.png') }}"
                    alt="logo">
                Kabaena <span class="text-red-700">CUP</span>
            </a>
            <div class="w-full rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class=" flex justify-center  text-4xl font-bold leading-tight tracking-tight  md:text-2xl text-white font-poppins uppercase">
                        Login
                    </h1>
                    @if ($data = Session::get('success'))
                        <div class="flex items-center p-4 mb-4 text-sm text-red-600 border border-red-300 rounded-lg bg-green-50"
                            role="alert">
                            <x-uiw-notification class="w-6" />
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">{{ $data }}</span> &#128078;
                            </div>
                        </div>
                    @endif
                    <form class="space-y-4 md:space-y-6" action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div>
                            <label for="username"
                                class="block mb-2 text-lg font-medium font-poppins text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class=" border   rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="kabaena_cup" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-lg font-medium text-white font-poppins">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class=" border   rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                required="">
                        </div>
                </div>
                <div class="flex justify-center w-full px-2 py-2 mx-2 my-2">
                    <button type="submit"
                        class=" w-[250px] text-white bg-red-700 hover:bg-black hover:text-red-700 focus:ring-4 focus:outline-none  font-medium rounded-lg text-lg px-5 py-2.5 text-center my-4">Login</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>
