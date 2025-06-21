@extends('layout.user')
@section('title', 'Schedule')
@section('content')

    <div class="w-full mt-6 md:mt-14">
        {{-- heading schedule --}}
        <div class="mb-4 border-b  border-gray-700">
            <x-heading name="schedule" margin="0" />
        </div>
        {{-- tab schedule --}}
        <div x-data="scheduleGet()" x-cloak>
            <!-- Tab Headers -->
            <div class="mb-4 border-b border-gray-900">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center text-white">
                    @for ($i = 1; $i <= $maxDay; $i++)
                        <li class="me-2" role="presentation">
                            <button @click="activeTab = 'day{{ $i }}'"
                                :class="{
                                    'text-red-600 border-red-500': activeTab === 'day{{ $i }}',
                                    'hover:text-red-700 text-white': activeTab !== 'day{{ $i }}'
                                }"
                                class="inline-block p-4 border-b-2 rounded-t-lg" type="button">
                                day {{ $i }}
                            </button>
                        </li>
                    @endfor
                </ul>
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="text-white text-center py-2">
                <div class="flex-col gap-4 w-full flex items-center justify-center">
                    <div
                        class="w-28 h-28 border-8 text-red-600 text-4xl animate-spin border-gray-300 flex items-center justify-center border-t-red-600 rounded-full">
                        <img src="{{ asset('storage/image/logo/logo.png') }}" class="w-12 h-12 rounded-full animate-ping"
                            alt="Kabaena Logo" />
                    </div>
                </div>
            </div>

            <!-- Tab Contents -->

            <div x-show="schedules.length === 0 && !loading" class="text-white text-center py-4">
                Tidak ada jadwal pertandingan untuk hari ini.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4 items-center" x-show="!loading && tabShow"
                x-transition>
                <template x-for="item in schedules" :key="item.id">
                    <div
                        class="flex flex-col border-gray-700 bg-gray-900 shadow-xl shadow-gray-800/100 rounded-xl border-2 py-2 md:py-4">
                        <div class="flex flex-row justify-between items-center py-2 px-4 gap-[4px]">
                            <!-- Team 1 -->
                            <div class="flex flex-col justify-center items-center max-w-[240px]">
                                <img :src="safeImagePath(item.logoA)" :alt="'logo ' + item.timA"
                                    class="w-[64px] md:w-max-[90px] max-h-[80px] rounded-full object-contain mb-1">
                                <h2 class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white"
                                    x-text="item.timA"></h2>
                            </div>

                            <!-- Match Info -->
                            <div class="flex flex-row justify-around gap-2 items-center">
                                <h1 class="font-kodeMono font-extrabold text-red-600 text-5xl" x-text="item.scoreA"></h1>
                                <div class="flex flex-col justify-center items-center p-[4px]">
                                    <h1 class="text-white font-bold text-[16px] truncate text-center"
                                        x-text="formatTime(item.time)"></h1>
                                    <h1 class="text-white font-bold text-[14px] truncate text-center"
                                        x-text="formatDate(item.date)"></h1>
                                    <h1 class="text-red-500  font-bold text-[18px] font-kodeMono uppercase text-center"
                                        x-text="item.babak === 'regular' ? 'Grup phase' :  'knockout phase'">
                                    </h1>
                                </div>
                                <h1 class="font-kodeMono font-extrabold text-red-600 text-5xl" x-text="item.scoreB"></h1>
                            </div>

                            <!-- Team 2 -->
                            <div class="flex flex-col justify-center items-center max-w-[240px]">
                                <img :src="safeImagePath(item.logoB)" :alt="'logo ' + item.timB"
                                    class="w-[64px] md:w-max-[90px] max-h-[80px] rounded-full object-contain mb-1">
                                <h2 class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white"
                                    x-text="item.timB"></h2>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex justify-start px-4">
                <h3 class="font-poppins text-white text-[12px] md:text-sm italic font-bold">
                    <span class="text-red-600">*</span>Semua waktu dalam WITA (GMT+8)
                </h3>
            </div>
            <!-- Tambahkan ini untuk menangani kasus tidak ada schedule -->
        </div>

        {{-- tab standing --}}
        <div class="mb-4 border-b  border-gray-700">
            <x-heading name="standing" margin="0" />
        </div>
        {{-- Standing Section --}}
        <div x-data="standingGet({{ $grup->first()->id ?? 1 }})" x-cloak>
            <!-- Tab Headers -->
            <div class="mb-4 border-b border-gray-900">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-start text-white">
                    <li class="me-2" role="presentation">
                        <button @click="tabBabak('regular')"
                            :class="{
                                'text-red-600 border-red-500': activeBabak === 'regular',
                                'hover:text-red-700 text-white': activeBabak !== 'regular'
                            }"
                            class="inline-block p-4 border-b-2 rounded-t-lg" type="button">
                            Grup
                        </button>
                    </li>
                    {{-- if babak equal playoff --}}
                    @if ($babak === 'playoff')
                        <li class="me-2" role="presentation">
                            <button @click="tabBabak('playoff')"
                                :class="{
                                    'text-red-600 border-red-500': activeBabak === 'playoff',
                                    'hover:text-red-700 text-white': activeBabak !== 'playoff'
                                }"
                                class="inline-block p-4 border-b-2 rounded-t-lg" type="button">
                                playoff
                            </button>
                        </li>
                    @endif
                </ul>
            </div>
            {{-- grup button --}}
            <div x-show=" tabShow && activeBabak === 'regular'" class="mb-4 border-b border-gray-900">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center text-white">
                    @foreach ($grup as $item)
                        <li class="me-2" role="presentation">
                            <button @click="changeTab({{ $item->id }})"
                                :class="{
                                    'text-red-600 border-red-500': activeTab === {{ $item->id }},
                                    'hover:text-red-700 text-white': activeTab !== {{ $item->id }}
                                }"
                                class="inline-block p-4 border-b-2 rounded-t-lg" type="button">
                                Grup {{ $item->grup }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="text-white text-center py-2">
                <div class="flex-col gap-4 w-full flex items-center justify-center">
                    <div
                        class="w-28 h-28 border-8 text-red-600 text-4xl animate-spin border-gray-300 flex items-center justify-center border-t-red-600 rounded-full">
                        <img src="{{ asset('storage/image/logo/logo.png') }}" class="w-12 h-12 rounded-full animate-ping"
                            alt="Logo" />
                    </div>
                </div>
            </div>

            <!-- Content grup -->
            <div x-show="!loading && tabShow && activeBabak === 'regular'" x-transition>
                <template x-if="standings.length > 0">
                    <div class="w-full bg-gray-900 rounded-lg shadow-md p-4">
                        <div class="overflow-x-auto w-full">
                            <table class="w-full text-sm text-left text-gray-300">
                                <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 ">Squad</th>
                                        <th scope="col" class="px-2 py-3 text-center">Pts</th>
                                        <th scope="col" class="px-2 py-3 text-center">GAME</th>
                                        <th scope="col" class="px-2 py-3 text-center">WIN</th>
                                        <th scope="col" class="px-2 py-3 text-center">LOSE</th>
                                        <th scope="col" class="px-2 py-3 text-center">WR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="standing in standings" :key="standing.id">
                                        <tr class="border-b border-gray-700 hover:bg-gray-800">
                                            <th scope="row" class="px-4 py-2 font-medium whitespace-nowrap text-white">
                                                <span class="flex items-center gap-2 flex-row">
                                                    <img :src="'{{ asset('storage/image/logo/') }}' + '/' + standing.logo"
                                                        :alt="'logo ' + standing.squad"
                                                        class="w-6 h-6 rounded-full object-contain ">
                                                    <span x-text="standing.short_squad"></span>
                                                </span>
                                            </th>
                                            <td class="px-2 py-2 text-center font-medium whitespace-nowrap text-white">
                                                <span x-text="standing.poin"></span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <span x-text="standing.game"></span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <span x-text="standing.win"></span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <span x-text="standing.lose"></span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <span x-text="standing.winrate + '%'"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>

                <template x-if="standings.length === 0 && !loading">
                    <div class="text-white text-center py-4">
                        Tidak ada data klasemen untuk grup ini.
                    </div>
                </template>
            </div>

            {{-- if babak equal playoff --}}
            @if ($babak === 'playoff')
                {{-- contect playoff --}}
                <div x-show="!loading && tabShow && activeBabak === 'playoff'" x-transition>
                    <img src="{{ asset('storage/image/banner/' . $playoff_banner) }}" alt="banner playoff"
                        class="w-full md:w-[720px] h-auto rounded-lg shadow-md mb-4 flex justify-center items-center mx-auto">
                </div>
            @endif
        </div>
    </div>






@endsection
