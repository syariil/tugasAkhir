@extends('layout.admin')
@section('title', $tim->squad)
@section('content')

    <section class="mt-4 md:mt-14 md:p-2 p-1">
        <div class="w-full  text-white mt-4">

            <div class=" mx-auto max-w-screen-2xl py-10 p-4 md:p-6 2xl:p-10">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-xl md:text-4xl font-bold font-kodeMono"> {{ $tim->squad }} </h1>
                        <p class="text-gray-100 mt-2 md:text-lg text-sm">
                            Ketua : <span class="text-red-100 font-poppins font-bold"> {{ $tim->leader }} </span>
                        </p>
                        <p class="text-gray-100 mt-1 md:text-lg text-sm">
                            Whatsapp : <span class="text-red-100 font-poppins font-bold"> +62{{ $tim->no_whatsapp }}
                            </span>
                        </p>
                        <p class="text-gray-100 mt-2 md:text-lg text-sm">
                            Short Squad : <span class="text-red-100 font-poppins font-bold"> {{ $tim->short_squad }} </span>
                        </p>
                        <p class="text-gray-100 mt-1 md:text-lg text-sm">
                            Season : <span class="text-red-100 font-poppins font-bold"> {{ $tim->season }} </span>
                        </p>
                    </div>
                    <div>
                        <a href="{{ asset('storage/image/logo/' . $tim->logo) }}">
                            <img src="{{ asset('storage/image/logo/' . $tim->logo) }}" alt="Logo tim"
                                class="md:w-[150px] w-[105px] h-[105px] md:h-[150px] rounded-full border-2 object-fill border-gray-700">
                        </a>
                    </div>
                </div>

                <!-- player -->
                <div class="grid md:grid-row-2 gap-6 mb-8">
                    @for ($i = 0; $i < 6; $i++)
                        @if ($tim->{'nickname' . ($i + 1)} == null)
                            @continue
                        @endif
                        <div class="p-4 bg-gray-800 rounded-lg">
                            <h2 class="text-lg font-semibold">Player {{ $i + 1 }}</h2>
                            <p class="text-gray-300">nickname : {{ $tim->{'nickname' . ($i + 1)} }} </p>
                            <p class="text-gray-300">id : {{ $tim->{'id_nickname' . ($i + 1)} }} </p>
                        </div>
                    @endfor
                    @if ($registration || auth()->user()->role === 'admin')
                        <div class="flex justify-start  w-full">
                            <div class="w-full">
                                <a href="{{ route('tim.edit', $tim->id) }}"
                                    class="flex justify-center px-4 py-2 items-center text-white bg-blue-600 rounded-lg w-full">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
