@extends('layout.admin')
@section('title', 'Standing')
@section('content')
    <div class="mt-14 p-2">
        <div class="w-full  rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Standing List
                    </h2>
                </div>
                @if ($tim = Session::get('success'))
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg  bg-gray-900 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <x-uiw-notification class="w-6" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $tim }}</span>;
                        </div>
                    </div>
                @endif
                @if ($tim = Session::get('delete'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg  bg-gray-900 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <x-uiw-notification class="w-6" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $tim }}</span>;
                        </div>
                    </div>
                @endif
            </div>

                {{-- content --}}
                <div id="standingManajemen">
                    {{-- grup --}}
                    {{-- standing --}}
                    <div class=" p-2 rounded-lg " id="standing" role="tabpanel">
                        <div class="w-full flex flex-col justify-start items-center mb-2 gap-2">
                            <div class="flex w-full justify-end flex-col">
                                <div class="flex justify-end flex-col-reverse md:flex-row gap-2 md:gap-0">
                                    <button data-modal-target="standing-add" data-modal-toggle="standing-add"
                                        class=" flex flex-row text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-3 py-1.5 md:py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 items-center"
                                        type="button">
                                        <x-uiw-plus class="text-white w-4 md:w-5 font-bold mx-1" />
                                        <span class="font-poppins capitalize">standing</span>
                                    </button>
                                    <form action="{{ route('standing.index') }}" method="GET" class="flex flex-row">
                                        <div class="flex justify-center w-full">
                                            <div class="flex justify-center mx-2 w-full">
                                                <select name="season"
                                                    class="bg-gray-900 text-white p-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent w-full">
                                                    <option value="">Pilih Season</option>
                                                    @for ($i = 1; $i <= $seasons[0]->season; $i++)
                                                        <option value="{{ $i }}">
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <button type="submit"
                                                class="bg-red-600 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                                Filter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="w-full flex justify-center">
                                <table class="w-full text-sm text-gray-200 bg-gray-800 rounded-t-lg">
                                    <thead class="text-xs uppercase bg-red-700 text-white">
                                        <tr>
                                            <th class="px-3 md:px-6 py-3">Grup</th>
                                            <th class="px-3 md:px-6 py-3">Team</th>
                                            <th class="px-3 md:px-6 py-3">Season</th>
                                            <th class="px-3 md:px-6 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($arrayTim as $item)
                                            @if (!empty($item))
                                                <tr class="border-b bg-gray-900 border-gray-700">
                                                    <td class="px-3 md:px-6 py-4 font-medium uppercase text-white">
                                                        {{ $grup[$i]['grup'] }}
                                                    </td>
                                                    <td class="px-3 md:px-6 py-4 font-medium uppercase text-white">
                                                        <div class="flex flex-col">
                                                            @foreach ($item as $squad)
                                                                @if ($squad['id_grup'] == $grup[$i]['id_grup'])
                                                                    <span>- {{ $squad['squad'] }}</span>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="px-3 md:px-6 py-4 font-medium uppercase text-white">
                                                        {{ $grup[$i]['season'] }}
                                                    </td>
                                                    <td class="py-4 px-2 md:px-6">
                                                        <a href="{{ route('standing.edit', $grup[$i]['id_grup']) }}"
                                                            class="text-white px-4 py-2 rounded-lg bg-blue-600 hover:underline">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{-- end content --}}
        </div>
                    </div>
            </div>
            
        </div>




        {{-- modal add standing --}}
        <div id="standing-add" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold  text-white capitalize font-kodeMono">
                            Add Standing
                        </h3>
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="standing-add">
                            <x-uiw-close class="w-8" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="flex w-full justify-center items-center p-4">
                        <div class="w-full" x-data="standingAdd()">
                            <form class="space-y-6" method="POST" action="{{ route('standing.store') }}">
                                @csrf
                                <template x-for="(match, index) in matches" :key="index">
                                    <div class="p-4 bg-gray-900 border border-gray-600 rounded-lg space-y-4">
                                        <h3 class="text-lg font-semibold font-kodeMono text-white">
                                            Standing <span x-text="index + 1"></span>
                                        </h3>
                                        <div class="flex md:flex-row gap-2">
                                            <div>
                                                <label :for="'grup-' + index" class="block text-sm font-medium text-white">
                                                    Grup
                                                </label>
                                                <select :id="'grup-' + index" x-model="match.grup"
                                                    x-bind:name="'matches[' + index + '][id_grup]'"
                                                    class="border   text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="" disabled selected>Pilih grup </option>
                                                    @foreach ($grup as $item)
                                                        <option value="{{ $item['id_grup'] }}">{{ $item['grup'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label :for="'tim-' + index" class="block text-sm font-medium text-white">
                                                    Tim
                                                </label>
                                                <select :id="'tim-' + index" x-model="match.tim"
                                                    x-bind:name="'matches[' + index + '][id_tim]'"
                                                    class="border   text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="" disabled selected>Pilih Tim </option>
                                                    @foreach ($tims as $item)
                                                        <option value="{{ $item->id }}">{{ $item->squad }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Remove Match -->
                                        <button type="button" @click="removeMatch(index)"
                                            class="text-white hover:bg-red-700 text-sm mt-2 bg-red-600 p-2 rounded-xl">
                                            Remove
                                        </button>
                                    </div>
                                </template>

                                <div class="flex justify-between">
                                    <button type="button" @click="addMatch"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Add Standing
                                    </button>
                                    <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            function standingAdd() {

                return {
                    matches: [{
                        grup: "",
                        tim: "",
                    }, ],
                    addMatch() {
                        this.matches.push({
                            grup: "",
                            tim: "",
                        });
                    },
                    removeMatch(index) {
                        this.matches.splice(index, 1);
                    },
                };
            }
        </script>

    </div>
@endsection
