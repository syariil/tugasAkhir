@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="p-0">
        <div
            class="w-[calc(100%-256px+256px)] h-screen items-end flex justify-center bg-dashboard bg-no-repeat bg-fixed bg-center bg-opacity-5 opacity-10 bg-cover fixed z-[-10]">
        </div>
        <div class=" h-screen w-full flex items-center justify-center">
            <div class="block">
                <h1
                    class="text-red-600 font-poppins uppercase text-center text-[32px] font-bold underline drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,1)] outline-4">
                    welcome,
                </h1>
                <h3
                    class="text-white font-poppins capitalize text-center text-[24px] font-semibold rop-shadow-[0_1.2px_1.2px_rgba(0,0,0,1)] outline-4">
                    {{ auth()->user()->role === 'admin' ? 'Admin' : 'peserta' }}
                    {{ Auth::user()->username }}
                </h3>
            </div>
        </div>

    </div>

@endsection
