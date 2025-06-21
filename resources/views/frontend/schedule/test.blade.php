@extends('layout.user')
@section('title', 'Schedule')
@section('content')

    <div class="w-full mt-6 md:mt-14">
        {{-- heading schedule --}}
        <div class="mb-4 border-b border-gray-700">
            <x-heading name="schedule" margin="0" />
        </div>

        {{-- Schedule Section --}}
        <div x-data="standingData" x-cloak>
            <!-- Tab Headers -->
            <div class="mb-4 border-b border-gray-900">
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

            <!-- Content -->
            <div x-show="!loading && tabShow" x-transition>
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
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('standingData', () => ({
                    activeTab: {{ $grup->first()->id ?? 0 }}, // Default to first grup id
                    loading: true,
                    standings: [],
                    tabShow: false,

                    init() {
                        // Load initial data
                        this.fetchStandings();
                    },

                    changeTab(grupId) {
                        this.activeTab = grupId;
                        this.tabShow = false;
                        this.loading = true;
                        this.standings = [];
                        this.fetchStandings();
                    },

                    fetchStandings() {
                        fetch(`{{ url('/api/standings') }}/${this.activeTab}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                this.standings = data;
                                this.loading = false;
                                this.tabShow = true;
                            })
                            .catch(error => {
                                console.error('Error fetching standings:', error);
                                this.loading = false;
                                this.tabShow = true;
                                this.standings = [];
                            });
                    }

                }));
            });
        </script>
    </div>
@endsection
