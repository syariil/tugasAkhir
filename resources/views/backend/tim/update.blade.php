@extends('layout.admin')
@section('title', 'nama tim')
@section('content')
    <div class="p-4 mt-14">
        <form class="max-w-2xl mx-auto" method="POST" action="{{ route('tim.update', $tim->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- step one register --}}
            <div id="step-one-register" class="block relative animate-jump-in">
                <x-heading name="data team {{ $tim->squad }}" margin="0" />
                <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-2">
                    <div class="md:mb-3 mb-5 w-full">
                        <label label="ketua" class="block mb-2 text-sm font-medium text-white capitalize">
                            Ketua
                        </label>
                        <input type="text" name="leader" value="{{ $tim->leader }}"
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
                        <input type="number" name="no_whatsapp" value="62{{ $tim->no_whatsapp }}"
                            class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="Nomor whatsapp ketua" />
                        @error('no_whatsapp')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-2">
                    <div class="md:mb-3 mb-5 w-full">
                        <label label="squad" class="block mb-2 text-sm font-medium text-white capitalize">
                            Squad
                        </label>
                        <input type="text" name="squad" value="{{ $tim->squad }}"
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
                        <input type="text" name="short_squad" value="{{ $tim->short_squad }}"
                            class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                            placeholder="kependekan nama squad maksimal 6 karakter" />
                        @error('short_squad')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @if (auth()->user()->role === 'admin')
                    <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-2">
                        <div class="md:mb-3 mb-5 w-full">
                            <label label="squad" class="block mb-2 text-sm font-medium text-white capitalize">
                                Season
                            </label>
                            <input type="number" name="season" value="{{ $tim->season }}"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                placeholder="nama Squad" />
                            @error('season')
                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="mb-0 md:mb-5 flex flex-col md:flex-row  justify-start gap-0 md:gap-10">
                    <div class="md:mb-3 mb-5 w-full">
                        <label class="block mb-2 text-sm font-medium text-white capitalize">Upload Logo</label>
                        <input name="logo"
                            class="block w-full md:w-sm text-sm border rounded-lg cursor-pointer  text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                            type="file">
                        @error('logo')
                            <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- end step one register --}}



            {{-- step two register --}}
            <div id="step-two-register" class="hidden animate-jump-in ">
                <x-heading name="data player {{ $tim->squad }}" margin="0" />
                <div class="mb-0 md:mb-5">
                    <div class="md:mb-3 mb-5 w-full">
                        <label label="player 1" class="block mb-2 text-sm font-medium text-white capitalize"> Player
                            1
                        </label>
                        <div class="flex flex-col md:flex-row gap-2">
                            <div class="w-full">
                                <input type="text" name="nickname1" value="{{ $tim->nickname1 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 1" />
                                @error('nickname1')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname1" value="{{ $tim->id_nickname1 }}"
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
                                <input type="text" name="nickname2" value="{{ $tim->nickname2 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 2" />
                                @error('nickname2')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname2" value="{{ $tim->id_nickname2 }}"
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
                                <input type="text" name="nickname3" value="{{ $tim->nickname3 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 3" />
                                @error('nickname3')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname3" value="{{ $tim->id_nickname3 }}"
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
                                <input type="text" name="nickname4" value="{{ $tim->nickname4 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 4" />
                                @error('nickname4')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname4" value="{{ $tim->id_nickname4 }}"
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
                                <input type="text" name="nickname5" value="{{ $tim->nickname5 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 5" />
                                @error('nickname5')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname5" value="{{ $tim->id_nickname5 }}"
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
                            6
                        </label>
                        <div class="flex flex-col md:flex-row gap-2">
                            <div class="w-full">
                                <input type="text" name="nickname6" value="{{ $tim->nickname6 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="Nickname player 6" />
                                @error('nickname6')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <input type="number" name="id_nickname6" value="{{ $tim->id_nickname6 }}"
                                    class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
                                    placeholder="id player 6" />
                                @error('id_nickname6')
                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
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
                    class=" text-white animate-jump-in focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">
                    Update
                </button>
            </div>
        </form>
    </div>
    <script>
        const bntNext = document.getElementById("btnNext");
        const bntPrev = document.getElementById("btnPrev");
        const bntSubmit = document.getElementById("btnSubmit");
        const stepOne = document.getElementById("step-one-register");
        const stepTwo = document.getElementById("step-two-register");

        bntPrev.addEventListener("click", function() {
            bntNext.classList.replace("hidden", "block");
            stepOne.classList.replace("hidden", "block");
            bntSubmit.classList.replace("block", "hidden");
            stepTwo.classList.replace("block", "hidden");
        });

        bntNext.addEventListener("click", function() {
            bntSubmit.classList.replace("hidden", "block");
            stepTwo.classList.replace("hidden", "block");
            bntNext.classList.replace("block", "hidden");
            stepOne.classList.replace("block", "hidden");
        });
    </script>
@endsection
