@extends('layout.admin')
@section('title', 'Schedule')
@section('content')
    <div class="p-0 md:p-4 mt-14">
        <div class="w-full min-h-screen bg-gray-800 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        List Schedule {{ $squad }}
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-start gap-2 p-2">
                    @foreach ($schedule as $item)
                        <div
                            class="w-full md:max-w-[320px] flex flex-col border-gray-700 bg-gray-900 shadow-xl shadow-gray-800/100 rounded-xl border-2 py-2">
                            <div class="flex justify-center items-center">
                                <h1 class="text-red-600 font-poppins font-bold text-[18px] md:text-[24px] uppercase">
                                    day {{ $item->day }}
                                </h1>
                            </div>
                            <div class="  flex  flex-row justify-between items-center pb-2 px-2">
                                {{-- team 1 --}}
                                <div class="flex flex-col justify-center items-center max-w-[124px]">
                                    <img src="{{ asset('storage/image/logo/' . $item->logoA) }}" alt="logo "
                                        class=" max-w-[56px]  max-md:w-[64px]  rounded-full object-contain mb-1">
                                    <h2 class="font-poppins font-bold text-[14px] text-center uppercase text-white ">
                                        {{ $item->timA }}
                                    </h2>
                                </div>
                                {{-- time --}}
                                <div class="flex flex-row justify-between gap-2 items-center">
                                    <h1 class="font-kodeMono font-extrabold text-red-600 text-5xl">
                                        {{ $item->scoreA }}
                                    </h1>
                                    <div class="flex flex-col justify-center items-center ">

                                        <h1 class="text-white font-bold text-[16px]">
                                            {{ (new DateTime($item->time))->format('H:i ') }}
                                        </h1>
                                        </h1>
                                        <h1 class="text-white font-bold text-[12px] truncate text-center">
                                            {{ (\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y')) }}
                                            </h1>
                                    </div>
                                    <h1 class="font-kodeMono font-extrabold text-red-600 text-5xl">
                                        {{ $item->scoreB }}
                                    </h1>
                                </div>
                                {{-- team 2 --}}
                                <div class="flex flex-col justify-center items-center max-w-[124px]">
                                    <img src="{{ asset('storage/image/logo/' . $item->logoB) }}" alt="logo "
                                        class=" max-w-[56px]  max-md:w-[64px]  rounded-full object-contain mb-1">
                                    <h2 class="font-poppins font-bold text-[14px] text-center uppercase text-white ">
                                        {{ $item->timB }}
                                    </h2>
                                </div>
                                {{-- button --}}
                                {{-- end of one match --}}
                            </div>
                            <div class="flex flex-row justify-center  items-center px-3">
                                <h1 class="text-red-600 font-poppins font-bold text-[18px]  uppercase">
                                    {{ $item->babak }}
                                </h1>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
