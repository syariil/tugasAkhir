@extends('layout.admin')
@section('title', 'Highlight edit')
@section('content')
    <div class="p-4 mt-14">
        <div class="w-full  rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        edit Highlight {{ $highlight->judul }}
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-start gap-2 p-2">
                    <div class="flex w-full justify-center items-center ">
                        <div class="w-full">
                            <form method="POST" action="{{ route('highlight.update', $highlight->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="p-4      rounded-lg space-y-4">
                                    <!-- Tim A -->
                                    <div class="flex md:flex-row gap-2">
                                        <div>
                                            <label class="block text-sm font-medium text-white">Judul</label>
                                            <input type="text" name="judul" value="{{ $highlight->judul }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-900 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('judul')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                URL
                                            </label>
                                            <input type="text" name="url" value="{{ $highlight->url }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-900 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('url')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex md:flex-row gap-2">
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Thumbnail
                                            </label>
                                            <input name="thumbnail"
                                                class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-900 border-gray-600 placeholder-gray-400"
                                                type="file">
                                            @error('thumbnail')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <img src="{{ asset('storage/image/thumbnail/' . $highlight->thumbnail) }}"
                                                alt="thumbnail" class="w-[120px] object-contain">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between ">
                                    <button type="submit"
                                        class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                                        Update
                                    </button>
                                </div>

                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
