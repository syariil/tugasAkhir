@extends('layout.user')
@section('title', 'schedule')
@section('content')

    <div class="w-full p-2 h-screen flex justify-center items-center flex-col">
        <div
            class="w-[calc(100%-256px+256px)] h-screen items-end flex justify-center bg-dashboard bg-no-repeat bg-fixed bg-center bg-opacity-5 opacity-10 bg-cover fixed z-[-10]">
        </div>
        <h1 class="mt-14 bg-gray-800 p-4 rounded-xl">
            <span class="text-[32px] text-red-700 font-bold ">Maintanance Schedule</span>
        </h1>
        <h1 class=" bg-gray-800 p-4 rounded-xl">
            <span class="text-[24px] text-white font-bold ">Jadwal sedang tahap perbaikan. Ditunggu updetannya yaa
                &#128521;</span>
        </h1>
    </div>


@endsection
