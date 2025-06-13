@extends('layout.admin')
@section('title', 'Schedule')
@section('content')
    <div class="p-0 md:p-4 mt-14">
        <div class="w-full min-h-screen rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        List Schedule {{ $squad }}
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-center gap-2 p-2">
                    @foreach ($schedule as $item)
                        <div class="w-full md:max-w-[320px] flex flex-col border-gray-700 bg-gray-900 shadow-xl shadow-gray-800/100 rounded-xl border-2 py-1 md:py-2">
                                <div class="flex justify-center items-center">
                                    <h1 class="text-red-600 font-poppins font-bold text-[18px] md:text-[24px] uppercase">
                                        day {{ $item->day }}
                                    </h1>
                                </div>
                                <div class="  flex  flex-row justify-between items-center py-2 px-2 gap-[4px]">
                                    {{-- team 1 --}}
                                    <div class="flex flex-col justify-center items-center max-w-[240px]">
                                        <img src="{{ asset('storage/image/logo/' . $item->logoA) }}" alt="logo "
                                            class=" w-[64px]  md:w-max-[90px] max-h-[80px]  border-2 border-gray-300 rounded-full object-contain mb-1">
                                        <h2
                                            class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white ">
                                            {{ $item->timA }}
                                        </h2>
                                    </div>
                                    {{-- time --}}
                                    <div class="flex flex-row justify-around gap-2 items-center">
                                        <h1 class="font-kodeMono font-extrabold text-red-600 text-4xl md:text-5xl">
                                            {{ $item->scoreA }}
                                        </h1>
                                        <div class="flex flex-col justify-center items-center p-[1px]">
                                            <h1 class="text-white font-bold text-[14px] md:text-[12px] truncate text-center">
                                                {{ (new DateTime($item->time))->format('H:i') }}
                                            </h1>
                                            
                                            <h1 class="text-white font-bold text-[10px] md:text-[12px] truncate text-center">
                                                {{ (\Carbon\Carbon::parse($item->date)->translatedFormat('l')) }},
                                                {{ (\Carbon\Carbon::parse($item->date)->translatedFormat('d F ')) }}
                                            </h1>
                                        </div>
                                        <h1 class="font-kodeMono font-extrabold text-red-600 text-4xl md:text-5xl">
                                            {{ $item->scoreB }}
                                        </h1>
                                    </div>
                                    {{-- team 2 --}}
                                    <div class="flex flex-col justify-center items-center max-w-[240px]">
                                        <img src="{{ asset('storage/image/logo/' . $item->logoB) }}" alt="logo "
                                            class=" w-[64px]  md:w-max-[90px] max-h-[80px] border-2 border-gray-300 rounded-full object-contain mb-1">
                                        <h2
                                            class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white ">
                                            {{ $item->timB }}
                                        </h2>
                                    </div>
                                    {{-- end of one match --}}
                                    
                                </div>
                                <div class="flex justify-center items-center">
                                    <h1 class="text-red-600 font-poppins font-bold text-[18px] md:text-[24px] uppercase">
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
