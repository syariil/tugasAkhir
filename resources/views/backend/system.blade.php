@extends('layout.admin')
@section('title', 'system')
@section('content')
    <div class="mt-14 p-2">
        <section class="bg-gray-800  p-3 sm:p-5 min-h-screen">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-900 rounded-xl">
                <!-- Breadcrumb Start -->
                <h1 class="text-white font-poppins text-[24px] border-x-white border-b-2 uppercase font-bold">
                    Systems
                </h1>
                <div class="w-full px-2">
                    <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                        @if ($update = Session::get('success'))
                            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                                role="alert">
                                <x-uiw-notification class="w-6" />
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">{{ $update }}</span> ;
                                </div>
                            </div>
                        @endif
                        <div class="p-6 space-y-6">
                            <form action="{{ route('system.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="grid grid-row-1 gap-6 w-full">
                                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Banner
                                            </label>
                                            <input type="file" id="banner" name="banner"
                                                class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400">
                                            @error('banner')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            @if ($system != null)
                                                <img src="{{ asset('storage/image/banner/' . $system->banner) }}"
                                                    alt="banner" class="w-[120px]">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Playoff Banner
                                            </label>
                                            <input type="file" id="playoff_banner" name="playoff_banner"
                                                class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400">
                                            @error('playoff_banner')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            @if ($system != null)
                                                @if ($system->playoff_banner != null)
                                                    <img src="{{ asset('storage/image/banner/' . $system->playoff_banner) }}"
                                                        alt="banner" class="w-[120px]">
                                                @else
                                                    <img src="{{ asset('storage/image/banner/logo.png') }}" alt="banner"
                                                        class="w-[120px]">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label for="banner" class="block text-sm font-medium text-white">
                                            Babak
                                        </label>
                                        @if ($system == null)
                                            <select name="babak" id="babak"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                @foreach ($babak as $item)
                                                    <option value="{{ $item }}" class="capitalize">
                                                        {{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="babak" id="babak"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                @foreach ($babak as $item)
                                                    <option value="{{ $item }}" class="capitalize"
                                                        {{ old('babak', $system->babak ?? '') == $item ? 'selected' : '' }}>

                                                        {{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @error('babak')
                                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Season
                                            </label>
                                            @if ($system == null)
                                                <input type="numeric" id="season" name="season"
                                                    class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @else
                                                <input type="numeric" id="season" name="season"
                                                    value="{{ $system->season }}"
                                                    class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @endif
                                            @error('season')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Registration
                                            </label>
                                            @if ($system == null)
                                                <select name="registration" id="babak"
                                                    class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    @foreach ($registration as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize">
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="registration" id="babak"
                                                    class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    @foreach ($registration as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize"
                                                            {{ old('registration', $system->registration ?? '') == $item['value'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @error('registration')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Schedule
                                            </label>
                                            @if ($system == null)
                                                <select name="schedule" id="schedule"
                                                    class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    @foreach ($schedule as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize">
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="schedule" id="babak"
                                                    class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    @foreach ($schedule as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize"
                                                            {{ old('registration', $system->schedule ?? '') == $item['value'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @error('schedule')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                poin
                                            </label>
                                            @if ($system == null)
                                                <input type="numeric" id="poin" name="poin"
                                                    class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @else
                                                <input type="numeric" id="poin" name="poin"
                                                    value="{{ $system->poin }}"
                                                    class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @endif
                                            @error('poin')
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
