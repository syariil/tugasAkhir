@extends('layout.user')
@section('title', 'Schedule')
@section('content')

    <div class="w-full mt-14">
        {{-- heading schedule --}}
        <div class="mb-4 border-b  border-gray-700">

            <x-heading name="schedule" margin="0" />
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="schedule-styled-tab"
                data-tabs-toggle="#schedule"
                data-tabs-active-classes="hover:text-red-600 text-red-500 hover:text-red-500 border-red-600 border-red-500"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-6 border-b-2 rounded-t-lg" id="regular-styled-tab"
                        data-tabs-target="#regular" type="button" role="tab" aria-controls="regular"
                        aria-selected="false">Playoff</button>
                </li>
            </ul>
        </div>
        {{-- tab schedule --}}
        <div id="schedule">
            <div class="hidden p-4 rounded-lg  bg-gray-900" id="regular" role="tabpanel" aria-labelledby="regular-tab">
                {{-- headeing --}}
                <div class="mb-4 border-b  border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="schedule1-styled-tab"
                        data-tabs-toggle="#schedule1"
                        data-tabs-active-classes="hover:text-red-600 text-red-500 hover:text-red-500 border-red-600 border-red-500"
                        role="tablist">
                        @for ($i = 1; $i <= $day; $i++)
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="regular-styled-tab"
                                    data-tabs-target="#day{{ $i }}" type="button" role="tab"
                                    aria-controls="regular" aria-selected="false">day {{ $i }}</button>
                            </li>
                        @endfor
                    </ul>
                </div>
                <div id="schedule1">
                    @for ($i = 1; $i <= $day; $i++)
                    <div class="p-4 rounded-lg   w-full flex flex-wrap flex-col md:flex-row justify-center items-center gap-2"
                        id="day{{ $i }}" role="tabpanel" aria-labelledby="regular-tab">
                        @foreach ($schedules as $item)
                            @if ($i == $item->day)
                                <div class="w-full md:max-w-[360px] flex flex-col border-gray-700 bg-gray-700 shadow-xl shadow-gray-800/100 rounded-xl border-2 py-2 md:py-4">
                                    <div class="  flex  flex-row justify-between items-center py-2 px-2 gap-2">
                                        {{-- team 1 --}}
                                        <div class="flex flex-col justify-center items-center max-w-[240px]">
                                            <img src="{{ asset('storage/image/logo/' . $item->logoA) }}" alt="logo "
                                                class=" w-[72px]  md:w-[90px]  rounded-full object-contain mb-1">
                                            <h2
                                                class="font-kodeMono font-bold text-[18px] text-center uppercase text-white ">
                                                {{ $item->timA }}
                                            </h2>
                                        </div>
                                        {{-- time --}}
                                        <div class="flex flex-row justify-around gap-2 items-center">
                                            <h1 class="font-kodeMono font-extrabold text-red-600 text-5xl">
                                                {{ $item->scoreA }}
                                            </h1>
                                            <div class="flex flex-col justify-center items-center p-2">
                                                <h1 class="text-white font-bold text-[16px]">
                                                    {{ (new DateTime($item->time))->format('H:i') }}
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
                                        <div class="flex flex-col justify-center items-center max-w-[240px]">
                                            <img src="{{ asset('storage/image/logo/' . $item->logoB) }}" alt="logo "
                                                class=" w-[72px]  md:w-[90px]  rounded-full object-contain mb-1">
                                            <h2
                                                class="font-kodeMono font-bold text-[18px] text-center uppercase text-white ">
                                                {{ $item->timB }}
                                            </h2>
                                        </div>
                                        {{-- end of one match --}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endfor
                </div>
            </div>

        </div>

        {{-- heading standing --}}
        <div class="mb-4 border-b  border-gray-700">
            <x-heading name="Standing" margin="0" />
            <div class="w-full flex justify-center items-center p-4">
                <img src="{{ asset('storage/image//banner/' . $playoff_banner[0]->playoff_banner) }}" alt="playoff banner"
                    class="w-full md:w-[720px] object-contain">
            </div>
        </div>
        {{-- tab heading --}}

    </div>









@endsection
