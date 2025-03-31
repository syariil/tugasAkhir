@extends('layout.admin')
@section('title', 'system')
@section('content')
    <div class="mt-[70px] p-0 md:p-2">
        <nav class="flex bg-gray-800 px-4 py-3 rounded">
            <ol class="inline-flex items-center space-x-1 text-white">
                <li><a href="{{ route('dashboard') }}" class="hover:text-red-600">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li>System</li>
            </ol>
        </nav>
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
                                            @if ($system !== null)
                                                <img src="{{ asset('storage/image/banner/' . $system->banner) }}"
                                                    alt="banner" class="w-[120px]">
                                            @else
                                                <img src="{{ asset('storage/image/banner/logo.png') }}" alt="banner"
                                                    class="w-[120px]">
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
                                                <img src="{{ asset('storage/image/banner/' . $system->playoff_banner) }}"
                                                    alt="banner" class="w-[120px]">
                                            @else
                                                <img src="{{ asset('storage/image/banner/logo.png') }}" alt="banner"
                                                    class="w-[120px]">
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
                                            <input type="numeric" id="season" name="season"
                                                value="{{ isset($system) ? $system->season : '' }}"
                                                class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('season')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Registration
                                            </label>
                                            <select name="registration" id="babak"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                @if (isset($system))
                                                    @foreach ($registration as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize"
                                                            {{ old('registration', $system->registration ?? '') == $item['value'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($registration as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize">
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
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
                                            <select name="schedule" id="babak"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                @if (isset($system))
                                                    @foreach ($schedule as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize"
                                                            {{ old('registration', $system->schedule ?? '') == $item['value'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($schedule as $item)
                                                        <option value="{{ $item['value'] }}" class="capitalize">
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('schedule')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                poin
                                            </label>
                                            <input type="numeric" id="poin" name="poin"
                                                value="{{ isset($system) ? $system->poin : '' }}"
                                                class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('poin')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-2 md:gap-4">
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Nomor Rekening
                                            </label>
                                            <input type="numeric" id="no_rek" name="no_rek"
                                                value="{{ isset($system) ? $system->no_rek : '' }}"
                                                class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('no_rek')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label for="banner" class="block text-sm font-medium text-white">
                                                Bank
                                            </label>
                                            <input type="text" id="bank" name="bank"
                                                value="{{ isset($system) ? $system->bank : '' }}"
                                                class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('bank')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label for="banner" class="block text-sm font-medium text-white">
                                            Fee
                                        </label>
                                        <input type="numeric" id="fee-input" name="fee"
                                            value="{{ isset($system) ? number_format($system->fee, 0, ',', '.') : '' }}"
                                            class="border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                        @error('fee')
                                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                {{ $message }}</p>
                                        @enderror
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fee = document.getElementById("fee-input");
            if (fee.value) {
                fee.value = new Intl.NumberFormat("id-ID").format(feeInput.value.replace(/\./g, ""));
            }

            fee.addEventListener("input", function() {
                let value = this.value.replace(/\./g, "");
                if (!isNaN(value) && value !== "") {
                    this.value = new Intl.NumberFormat("id-ID").format(value);
                } else {
                    this.value = "";
                }
            });
        });
    </script>
@endsection
