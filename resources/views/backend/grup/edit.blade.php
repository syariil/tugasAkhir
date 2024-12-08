@extends('layout.admin')
@section('title', 'system')
@section('content')
    <div class="mt-14 p-2">
        <section class="bg-gray-800  p-3 sm:p-5 min-h-screen">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-900 rounded-xl">
                <!-- Breadcrumb Start -->
                <h1 class="text-white font-poppins text-[24px] border-x-white border-b-2 uppercase font-bold">
                    Edit Grup
                </h1>
                <div class="w-full px-2">
                    <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="p-6 space-y-6">
                            <form action="{{ route('grup.update', $grup->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="grid grid-row-1 w-full">
                                    <div class=" flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Grup
                                            </label>
                                            <input type="text" id="grup" name="grup" value="{{ $grup->grup }}"
                                                class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-red-500 focus:border-red-500">
                                            @error('grup')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Season
                                            </label>
                                            <input type="numeric" id="season" aria-label="disabled input" name="season"
                                                class="mb-6  border   text-sm rounded-lg   block w-full p-2.5 cursor-not-allowed bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-red-500 focus:border-red-500"
                                                value="{{ $grup->season }}" disabled>
                                            @error('season')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="text-white  focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">
                                            update
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
