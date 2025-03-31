@extends('layout.user')
@section('title', 'Registration')
@section('content')



    <form class="max-w-4xl mx-auto pt-10 z-10" method="POST" action="{{ route('register.store') }}"
        enctype="multipart/form-data">
        @csrf
        {{-- step one register --}}
        <div id="step-one-register" class="block ">
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
                    @error('logo')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label class="block mb-2 text-sm font-medium text-white capitalize">Bukti Pembayaran</label>
                    <input name="fee"
                        class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                        type="file">
                    @error('fee')
                        <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        {{-- end step one register --}}



        {{-- step two register --}}
        <div id="step-two-register" class="hidden">
            <x-heading name="data player" margin="0" />
            <div class="mb-0 md:mb-5">
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        1
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname1" value="{{ old('nickname1') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 1" />
                            @error('nickname1')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname1" value="{{ old('id_nickname1') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 1" />
                            @error('id_nickname1')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        2
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname2" value="{{ old('nickname2') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 2" />
                            @error('nickname2')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname2" value="{{ old('id_nickname2') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 2" />
                            @error('id_nickname2')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        3
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname3" value="{{ old('nickname3') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 3" />
                            @error('nickname3')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname3" value="{{ old('id_nickname3') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 3" />
                            @error('id_nickname3')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 4" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        4
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname4" value="{{ old('nickname4') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 4" />
                            @error('nickname4')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname4" value="{{ old('id_nickname4') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 4" />
                            @error('id_nickname4')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        5
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname5" value="{{ old('nickname5') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 5" />
                            @error('nickname5')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname5" value="{{ old('id_nickname5') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 5" />
                            @error('id_nickname5')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:mb-3 mb-5 w-full">
                    <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                        6 (optional)
                    </label>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <input type="text" name="nickname6" value="{{ old('nickname6') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="Nickname player 6" />
                            @error('nickname6')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <input type="number" name="id_nickname6" value="{{ old('id_nickname6') }}"
                                class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="id player 6" />
                            @error('id_nickname6')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center my-4">
                        <input id="default-checkbox" type="checkbox" value="1" required
                            class="w-4 h-4 text-red-600  rounded  focus:ring-red-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                        <label for="default-checkbox" class="ms-2 text-sm font-medium  text-gray-300">
                            saya setuju dengan kebijakan <a href="{{ route('privacy.policy') }}" target="_blank"
                                class="text-red-600 underline">privacy policy</a>
                            turnamen.
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="checked-checkbox" type="checkbox" value="1" required
                            class="w-4 h-4 text-red-600  rounded  focus:ring-red-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                        <label for="checked-checkbox" class="ms-2 text-sm font-medium  text-gray-300">
                            Saya sudah membaca <a href="{{ route('peraturan') }}" target="_blank"
                                class="text-red-600 underline">peraturan</a>
                            turnamen
                        </label>
                    </div>

                </div>
            </div>
        </div>
        {{-- end step two register --}}

        {{-- next step register --}}
        <div class="flex items-start mb-5">
            <button id="btnNext" type="button"
                class="block  text-white focus:ring-2 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 font-poppins">
                Next
            </button>
        </div>
        {{-- submit and previosly --}}
        <div id="btnSubmit" class="hidden  items-start gap-6">
            <button id="btnPrev" type="button"
                class=" text-black  focus:ring-2 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-gray-300 hover:bg-gray-500 focus:ring-gray-800">
                Prevously
            </button>
            <button id="btnRegist" type="submit"
                class=" text-white  focus:ring-2 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Register
            </button>
        </div>
    </form>

    <div class="w-full items-start mb-2 md:mb-9">
        <x-heading name="FAQ" margin="2" />
        <div id="accordion-collapse" data-accordion="collapse"
            class="w-full my-2 px-2 md:px-14 py-4 rounded-md bg-gray-800 ">
            <h2 id="harga">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#harga1" aria-expanded="false" aria-controls="harga1">
                    <span class="text-left">Berapa biaya pendaftaran turnamen kabaena cup season {{ $system->season }} ?
                    </span>
                    <x-uiw-down class="w-4" />


                </button>
            </h2>
            <div id="harga1" class="hidden" aria-labelledby="harga">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Biaya pendaftaran turnamen Kabaena Cup Season {{ $system->season }} adalah <span id="fee-value"
                            class="text-red-600">{{ number_format($system->fee, 0, ',', '.') }}</span> IDR. 
                    </p>
                </div>
            </div>
            <h2 id="biaya">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#biaya1" aria-expanded="false" aria-controls="biaya1">
                    <span class="text-left">Dimana saya harus mengirim biaya pendaftaran ? </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="biaya1" class="hidden" aria-labelledby="biaya">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Biaya pendaftaran di kirim ke : <span class="text-red-600"> {{ $system->no_rek }} </span> <span
                            class="text-blue-600"> {{ $system->bank }} </span>. Bukti transfer disimpan untuk dijadikan bukti pendaftaran di form pendaftaran.
                    </p>
                </div>
            </div>
            <h2 id="wa">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#wa1" aria-expanded="false" aria-controls="wa1">
                    <span class="text-left">Bagaimana penginputan nomor whatsapp? </span>
                    <x-uiw-down class="w-4" />


                </button>
            </h2>
            <div id="wa1" class="hidden" aria-labelledby="wa">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Penginputan nomor Whatsapp diawali dengan <span class="text-red-600">628</span> atau <span
                            class="text-red-600">08</span> dengan jumlah digit angka minimal 11 dan maksimal 13
                    </p>
                </div>
            </div>
            <h2 id="short_squad">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#short_squad1" aria-expanded="false" aria-controls="short_squad1">
                    <span class="text-left">Apa itu short squad? </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="short_squad1" class="hidden" aria-labelledby="short_squad">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        short squad adalah kependekapan nama squad dengan maksimal 6 karakter
                    </p>
                </div>
            </div>
            <h2 id="logo">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#logo1" aria-expanded="false" aria-controls="logo1">
                    <span class="text-left">Apakah saya bisa mendaftar tanpa logo squad? </span>
                    <x-uiw-down class="w-4" />


                </button>
            </h2>
            <div id="logo1" class="hidden" aria-labelledby="logo">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Ya tentu, jika kamu belum memiliki logo squad.
                    </p>
                </div>
            </div>
            <h2 id="file">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#file1" aria-expanded="false" aria-controls="file1">
                    <span class="text-left">Berapa ukuran maksimal mengupload file logo dan bukti biaya pendaftaran?
                    </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="file1" class="hidden" aria-labelledby="file">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        ukuran masing-masing file maksimal berukuran 5MB.
                    </p>
                </div>
            </div>
            <h2 id="player">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#player1" aria-expanded="false" aria-controls="player1">
                    <span class="text-left">Apakah saya bisa mendaftar tanpa player ke-6 atau cadangan? </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="player1" class="hidden" aria-labelledby="player">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Ya tentu, anda bisa mendaftar tanpa player ke-6 atau cadangan.
                    </p>
                </div>
            </div>
            <h2 id="player1">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#player11" aria-expanded="false" aria-controls="player11">
                    <span class="text-left">Apakah saya bisa mendaftar dengan player yang sama di squad yang sama? </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="player11" class="hidden" aria-labelledby="player1">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Kamu tidak bisa mendaftarkan tim kamu dengan player yang sama.
                    </p>
                </div>
            </div>
            <h2 id="menunggu">
                <button type="button"
                    class="flex items-center justify-between w-full p-4 font-medium rtl:text-right  border border-b-0  rounded-t-xl focus:ring-2 focus:ring-gray-900  border-gray-700 text-white bg-gray-900 hover:bg-gray-700  gap-3"
                    data-accordion-target="#menunggu1" aria-expanded="false" aria-controls="menunggu1">
                    <span class="text-left">Apa yang akan saya lakukan setelah mendaftar? </span>
                    <x-uiw-down class="w-4" />
                </button>
            </h2>
            <div id="menunggu1" class="hidden" aria-labelledby="menunggu">
                <div class="p-5 border border-b-0  border-gray-700 bg-gray-900">
                    <p class="mb-2  text-gray-300">
                        Setelah kamu melakukan pendaftaran, mohon untuk menunggu konfirmasi dari kami.
                        kami akan mengirimkan pesan konfirmasi dari nomor telpon yang anda inputkan. untuk
                        informasi lebih lanjut, kamu bisa menghubungi kami di instagram official kami <span
                            class="text-blue-600 underline"><a href="https://www.instagram.com/kabaena_cup"
                                target="_blank">@kabaena_cup</a></span>.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
