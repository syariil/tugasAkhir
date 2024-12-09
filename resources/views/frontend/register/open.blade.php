@extends('layout.user')
@section('title', 'Registration')
@section('content')



    <form class="max-w-4xl mx-auto py-4" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf
        {{-- step one register --}}
        <div id="step-one-register" class="block relative animate-jump-in">
            <x-heading name="data team" margin="0" />
            @if ($data = Session::get('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
                    role="alert">
                    <x-uiw-notification class="w-6" />
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ $data }}</span> Pendaftaran anda dalam pertinjauan panitia.
                        Tunggu konfirmasi dari panitia yaa &#128077;
                    </div>
                </div>
            @endif
            <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-between gap-0 md:gap-4">
                <div class="md:mb-3 mb-5 w-full">
                    <label label="ketua" class="block mb-2 text-sm font-medium text-white capitalize">
                        Ketua
                    </label>
                    <input type="text" name="leader" value="{{ old('leader') }}"
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                        placeholder="Nama ketua" />
                    @error('leader')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror

                </div>

                <div class="md:mb-3 mb-5 w-full">
                    <label label="No. Whatsapp" class="block mb-2 text-sm font-medium text-white capitalize">
                        No. Whatsapp
                    </label>
                    <input type="number" name="no_whatsapp" value="{{ old('no_whatsapp') }}"
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                        placeholder="Nomor whatsapp ketua" />
                    @error('no_whatsapp')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-4">
                <div class="md:mb-3 mb-5 w-full">
                    <label label="squad" class="block mb-2 text-sm font-medium text-white capitalize">
                        Squad
                    </label>
                    <input type="text" name="squad" value="{{ old('squad') }}"
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                        placeholder="nama Squad" />
                    @error('squad')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="Short Squad" class="block mb-2 text-sm font-medium text-white capitalize">
                        Short Squad
                    </label>
                    <input type="text" name="short_squad" value="{{ old('short_squad') }}"
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                        placeholder="kependekan nama squad maksimal 6 karakter" />
                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> maksimal 6 karakter</p>
                    @error('short_squad')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-4">
                <div class="md:mb-3 mb-5 w-full">
                    <label class="block mb-2 text-sm font-medium text-white capitalize">Logo team</label>
                    <input name="logo"
                        class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                        type="file">
                    <p class="mt-1 text-xs text-red-500 font-extrabold font-poppins"> tidak wajib</p>
                    @error('logo')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label class="block mb-2 text-sm font-medium text-white capitalize">Bukti Pembayaran</label>
                    <input name="fee"
                        class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                        type="file">
                    <p class="mt-1 text-xs text-red-500 font-extrabold font-poppins"> file gambar : jpg, jpeg, png;</p>
                    @error('fee')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        {{-- end step one register --}}



        {{-- step two register --}}
        <div id="step-two-register" class="hidden animate-jump-in ">
            <x-heading name="data player" margin="0" />
            <div class="mb-0 md:mb-5">
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        1
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname1" value="{{ old('nickname1') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 1" />
                        {{-- </div> --}}
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="number" name="id_nickname1" value="{{ old('id_nickname1') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 1" />
                        {{-- </div> --}}
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname1')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname1')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        2
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname2" value="{{ old('nickname2') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 2" />
                        <input type="number" name="id_nickname2" value="{{ old('id_nickname2') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 2" />
                        {{-- </div> --}}
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname2')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname2')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        3
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname3" value="{{ old('nickname3') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 3" />

                        <input type="number" name="id_nickname3" value="{{ old('id_nickname3') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 3" />
                        {{-- </div> --}}
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname3')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname3')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 4" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        4
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname4" value="{{ old('nickname4') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 4" />
                        <input type="number" name="id_nickname4" value="{{ old('id_nickname4') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 4" />
                        {{-- </div> --}}
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname4')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname4')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        5
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname5" value="{{ old('nickname5') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 5" />
                        {{-- </div> --}}
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="number" name="id_nickname5" value="{{ old('id_nickname5') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 5" />
                        {{-- </div> --}}
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname5')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname5')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        6
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="text" name="nickname6" value="{{ old('nickname6') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nickname player 6" />
                        {{-- </div> --}}
                        {{-- <div class="flex flex-col justify-center"> --}}
                        <input type="number" name="id_nickname6" value="{{ old('id_nickname6') }}"
                            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="id player 6" />
                    </div>
                    <div class="flex md:flex-row flex-col justify-between">
                        @error('nickname6')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                        @error('id_nickname6')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mb-4">
                    <input id="default-checkbox" type="checkbox" value="1" required
                        class="w-4 h-4 text-red-600  rounded  focus:ring-red-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                    <label for="default-checkbox" class="ms-2 text-sm font-medium  text-gray-300">
                        saya setuju dengan kebijakan <a href="{{ route('privacy.policy') }}" target="_blank"
                            class="text-red-600">privasy policy</a>
                        turnamen.
                    </label>
                </div>
                <div class="flex items-center">
                    <input checked id="checked-checkbox" type="checkbox" value="1" required
                        class="w-4 h-4 text-red-600  rounded  focus:ring-red-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                    <label for="checked-checkbox" class="ms-2 text-sm font-medium  text-gray-300">
                        Saya sudah membaca <a href="{{ route('peraturan') }}" target="_blank"
                            class="text-red-600">peraturan</a>
                        turnamen
                    </label>
                </div>

            </div>
        </div>
        {{-- end step two register --}}

        {{-- next step register --}}
        <div class="flex items-start mb-5">
            <button id="btnNext" type="button"
                class="block animate-jump-in text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 font-poppins">
                Next
            </button>
        </div>
        {{-- submit and previosly --}}
        <div id="btnSubmit" class="hidden  items-start gap-6 mb-5">
            <button id="btnPrev" type="button"
                class=" text-black animate-jump-in focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-gray-300 hover:bg-gray-500 focus:ring-gray-800">
                Prevously
            </button>
            <button id="btnRegist" type="submit"
                class=" text-white animate-jump-in focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Register
            </button>
        </div>
    </form>


@endsection
