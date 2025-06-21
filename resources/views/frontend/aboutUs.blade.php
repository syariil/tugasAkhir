@extends('layout.user')
@section('title', 'About Us')
@section('content')

    <section class="mt-14">
        <div class="min-h-screen  text-white mt-4">
            <div class="container mx-auto py-10">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-4xl font-bold font-kodeMono">Kabaena<span class="text-red-600">Cup</span></h1>
                        <p class="text-gray-400 mt-2">
                            Kabaena Cup adalah turnamen E-sport Mobile Legends Bang Bang
                        </p>
                    </div>
                    <div>
                        <img src="{{ asset('storage/image/logo1.png') }}" alt="Logo Turnamen"
                            class="md:w-[150px] w-20 h-20 md:h-[150px] rounded-full border-2 object-fill border-gray-400">
                    </div>
                </div>

                <!-- Info Utama -->
                <div class="grid md:grid-row-2 gap-6 mb-8">
                    <div class="p-6 bg-gray-800 rounded-lg">
                        <h2 class="text-lg font-semibold">Didirikan</h2>
                        <p class="text-gray-400">27 april 2019</p>
                    </div>
                    <div class="p-6 bg-gray-800 rounded-lg">
                        <h2 class="text-lg font-semibold">Lokasi</h2>
                        <p class="text-gray-400">Kabaena Timur, Bombana</p>
                    </div>
                    <div class="p-6 bg-gray-800 rounded-lg">
                        <h2 class="text-lg font-semibold">Email</h2>
                        <p class="text-sky-500 underline">
                            <a href="mailto:info@kabaenacup.com">info@kabaenacup.com</a>
                        </p>
                    </div>
                    <div class="p-6 bg-gray-800 rounded-lg">
                        <h2 class="text-lg font-semibold">Sosial media</h2>
                        <p class="text-gray-400 flex flex-row gap-4">
                            <a href="https://www.youtube.com/@kabaenacupmlbb888" target="_blank" class="flex items-center flex-row gap-2 text-red-500">
                                <x-uni-youtube-o class="h-6 w-6" /> Youtube
                            </a>
                            <a href="https://www.instagram.com/kabaena_cup" target="_blank" class="flex items-center flex-row gap-2 text-sky-600">
                                <x-uni-instagram-o class="h-6 w-6" /> Instagram
                            </a>
                            <a href="https://discord.gg/kabaenacup" target="_blank" class="flex items-center flex-row gap-2 text-blue-600">
                                <x-uni-discord-o class="h-6 w-6 " /> Discord
                            </a>
                        </p>
                    </div>
                <!-- Peserta -->
                {{-- <div class="p-6 bg-gray-800 rounded-lg mt-4">
                    <h2 class="text-2xl font-semibold mb-4">Pendiri</h2>
                    <div class="flex justify-around md:flex-row flex-col items-center md:gap-4 gap-2">
                        <!-- Peserta Item -->
                        <div
                            class="flex flex-col justify-center items-center bg-gray-700 p-4 rounded-lg w-full md:max-w-[430px]">
                            <img src="{{ asset('storage/image/R.png') }}" alt="Avatar"
                                class="w-[72px] object-contain rounded-full border-2 border-gray-600 mr-4">
                            <h3 class="font-medium">M. Riski D.</h3>
                        </div>

                        <div
                            class="flex flex-col justify-center items-center bg-gray-700 p-4 rounded-lg w-full md:max-w-[430px]">
                            <img src="{{ asset('storage/image/A.png') }}" alt="Avatar"
                                class="w-[72px] object-contain rounded-full border-2 border-gray-600 mr-4">
                            <h3 class="font-medium">Afdhal W. M</h3>
                        </div>
                    </div>
                    <div class="flex justify-center items-center py-2">
                        <div
                            class="flex flex-col justify-center items-center bg-gray-700 p-4 rounded-lg w-full md:max-w-[430px]">
                            <img src="{{ asset('storage/image/S.png') }}" alt="Avatar"
                                class="w-[72px] object-contain rounded-full border-2 border-gray-600 mr-4">
                            <h3 class="font-medium">M. Syahril</h3>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

@endsection
