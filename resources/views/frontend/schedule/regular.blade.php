@extends('layout.user')
@section('title', 'Schedule')
@section('content')

    <div class="w-full mt-14">
        {{-- heading schedule --}}
        <div class="mb-4 border-b  border-gray-700">
            <x-heading name="schedule" margin="0" />
        </div>
        {{-- tab schedule --}}
        <div id="schedule">
            <div class="block p-4 rounded-lg  bg-gray-900" id="regular" role="tabpanel" aria-labelledby="regular-tab">
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
                    <h3 class="font-poppins text-red-600 text-[12px] md:text-sm italic">
                        Semua waktu dalam WITA (GMT+8)
                    </h3>
                </div>
            </div>

        </div>

        {{-- heading standing --}}
        <div class="mb-4 border-b  border-gray-700">
            <x-heading name="Standing" margin="0" />
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="standing-styled-tab"
                data-tabs-toggle="#standing"
                data-tabs-active-classes="hover:text-red-600 text-red-500 hover:text-red-500 border-red-600 border-red-500"
                role="tablist">
                @foreach ($grup as $item)
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-6 border-b-2 rounded-t-lg" id="regular-styled-tab"
                            data-tabs-target="#grup{{ $item->id }}" type="button" role="tab"
                            aria-controls="{{ $item->id }}" aria-selected="true">Grup {{ $item->grup }}</button>
                    </li>
                @endforeach
            </ul>
        </div>
        {{-- tab heading --}}
        <div id="schedule">
            @foreach ($grup as $item)
                <div class="hidden p-4 rounded-lg  bg-gray-900" id="grup{{ $item->id }}" role="tabpanel"
                    aria-labelledby="regular-tab">
                    <div class="mx-auto full ">
                        <!-- Start coding here -->
                        <div class=" bg-gray-800 relative shadow-md sm:rounded-lg ">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left  text-gray-400">
                                    <thead class="text-xs  uppercase  bg-gray-700 text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Squad</th>
                                            <th scope="col" class="px-2 py-3">G</th>
                                            <th scope="col" class="px-2 py-3">W</th>
                                            <th scope="col" class="px-2 py-3">L</th>
                                            <th scope="col" class="px-2 py-3">WR</th>
                                            <th scope="col" class="px-2 py-3">Pts</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($standing as $standings)
                                            @if ($standings->id_grup == $item->id)
                                                <tr class="border-b border-gray-700">
                                                    <th scope="row"
                                                        class="px-4 py-3 font-medium  whitespace-nowrap text-white">
                                                        {{ $standings->squad }}
                                                    </th>
                                                    <td class="px-2 py-3">
                                                        {{ $standings->game }}
                                                    </td>
                                                    <td class="px-2 py-3">
                                                        {{ $standings->win }}
                                                    </td>
                                                    <td class="px-2 py-3">
                                                        {{ $standings->lose }}
                                                    </td>
                                                    <td class="px-2 py-3">
                                                        {{ $standings->winrate }}%
                                                    </td>
                                                    <td class="px-2 py-3 font-medium  whitespace-nowrap text-white">
                                                        {{ $standings->poin }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>









@endsection
