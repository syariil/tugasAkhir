@extends('layout.admin')
@section('title', 'Standing')
@section('content')
    <div class="mt-14 p-2">
        <div class="w-full  rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4  2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Standing List
                    </h2>
                </div>
                @if ($tim = Session::get('success'))
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg  bg-gray-900 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <x-uiw-notification class="w-6 text-white" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium text-white"> {{ $tim }}</span>;
                        </div>
                    </div>
                @endif
                @if ($tim = Session::get('delete'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg  bg-gray-900 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <x-uiw-notification class="w-6 text-white" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium text-white"> {{ $tim }}</span>;
                        </div>
                    </div>
                @endif
            </div>

            {{-- content --}}
            
            <div id="standingManajemen">
                {{-- grup --}}
                {{-- if user is not admin --}}
                @if (auth()->user()->role === 'admin')
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
                @endif
                <div class="mb-4 border-b  border-gray-700">
                    <x-heading name="Standing" margin="0" />
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center " id="standing-styled-tab" data-tabs-toggle="#standing" data-tabs-active-classes="hover:text-red-600 text-red-500 hover:text-red-500 border-red-600 border-red-500" role="tablist">
                        @foreach ($grups as $item)
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 md:p-6 border-b-2 rounded-t-lg" id="regular-styled-tab" data-tabs-target="#grup{{ $item->id }}" type="button" role="tab" aria-controls="{{ $item->id }}" aria-selected="true">
                                    Grup {{$item->grup }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- content --}}
                <div id="schedule">
                    @foreach ($grups as $item)
                        <div class="hidden p-4 rounded-lg  " id="grup{{ $item->id }}" role="tabpanel"
                            aria-labelledby="regular-tab">
                            <div class="mx-auto full ">
                                <!-- Start coding here -->
                                <div class=" bg-gray-900 relative shadow-md sm:rounded-lg ">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left  text-gray-300">
                                            <thead class="text-xs  uppercase  bg-gray-800 text-gray-300">
                                                <tr>
                                                    <th scope="col" class="px-2 py-3">No</th>
                                                    <th scope="col" class="px-4 py-3">Squad</th>
                                                    <th scope="col" class="px-2 py-3">G</th>
                                                    <th scope="col" class="px-2 py-3">W</th>
                                                    <th scope="col" class="px-2 py-3">L</th>
                                                    <th scope="col" class="px-2 py-3">WR</th>
                                                    <th scope="col" class="px-2 py-3">Pts</th>
                                                    {{-- if user is admin --}}
                                                    @if (auth()->user()->role === 'admin')
                                                        <th scope="col" class="px-2 py-3">action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($standing as $standings)
                                                    @if ($standings->id_grup == $item->id)
                                                        <tr class="border-b border-gray-700">
                                                            <th scope="row"
                                                                class="px-2 py-3 font-medium  whitespace-nowrap text-white">
                                                                {{ $no++ }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-4 py-3 font-medium  whitespace-nowrap text-white">
                                                                {{ $standings->short_squad }}
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
                                                            {{-- if user is admin --}}
                                                            @if (auth()->user()->role === 'admin')
                                                            <td>
                                                                <a href="{{ route('standing.editStanding', $standings->id) }}" class="font-medium  text-blue-500 font-poppins  underline  hover:underline px-2 py-1 rounded-3xl">
                                                                    edit
                                                                </a>

                                                                <button data-modal-target="tim-delete{{ $standings->id }}"
                                                                    data-modal-toggle="tim-delete{{ $standings->id }}"
                                                                    class="font-medium text-red-600 underline px-2 py-1 rounded-3xl  hover:underline">
                                                                    delete
                                                                </button>

                                                            </td>
                                                            @endif
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
        </div>
    </div>
    
    @if(auth()->user()->role === 'admin')
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
                                                    @foreach ($grups as $item)
                                                        <option value="{{ $item->id }}">{{ $item->grup }}</option>
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

        {{-- modal delete standing  --}}
        @foreach ($standing as $tim)
            <div id="tim-delete{{ $tim->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative  rounded-lg shadow bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-200 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="tim-delete{{ $tim->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4  w-12 h-12 text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal  text-gray-200">kamu yakin ingin menghapus
                                <span class="text-red-600 font-bold font-poppins">{{ $tim->short_squad }} </span> di grup
                                <span>{{ $tim->grup }}</span> ?
                            </h3>
                            <div class="w-full flex justify-center items-center">
                                <form action="{{ route('standing.delete', ['id' => $tim->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        yakin laa &#128539;
                                    </button>
                                </form>
                                <button data-modal-hide="tim-delete{{ $tim->id }}" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  rounded-lg border focus:z-10 focus:ring-4  focus:ring-gray-700 bg-gray-800 text-gray-200 border-gray-600 hover:text-white hover:bg-gray-700">
                                    ngga yakin sih &#128549;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
    @endif
@endsection
