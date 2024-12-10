@extends('layout.admin')
@section('title', 'standing')
@section('content')
    <div class="p-4 mt-14">
        <div class="w-full bg-gray-800 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        edit Standing tim {{ $standing[0]->squad }} grup {{ $standing[0]->grup }}
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-start gap-2 p-2">
                    <div class="flex w-full justify-center items-center ">
                        <div class="w-full">
                            <form method="POST" action="{{ route('standing.update', $standing[0]->id) }}">
                                @csrf
                                @method('put')
                                <div class="p-4 bg-gray-900 border border-gray-600 rounded-lg space-y-4">


                                    <!-- Tim A -->
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">Tim</label>
                                            <input type="text" name="squad" value="{{ $standing[0]->squad }}" disabled
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('squad')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">
                                                Grup
                                            </label>
                                            <input type="text" name="grup" value="{{ $standing[0]->grup }}" disabled
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('squad')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">Game</label>
                                            <input type="numeric" name="game" value="{{ $standing[0]->game }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('win')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">Win</label>
                                            <input type="numeric" name="win" value="{{ $standing[0]->win }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('win')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">
                                                Lose
                                            </label>
                                            <input type="numeric" name="lose" value="{{ $standing[0]->lose }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('lose')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">Winrate (%)</label>
                                            <input type="numeric" name="winrate" value="{{ $standing[0]->winrate }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('winrate')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">
                                                Poin
                                            </label>
                                            <input type="numeric" name="poin" value="{{ $standing[0]->poin }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('poin')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between ">
                                        <button type="submit"
                                            class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800">
                                            update
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            @endsection
