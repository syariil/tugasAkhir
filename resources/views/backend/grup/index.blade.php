@extends('layout.admin')
@section('title', 'grup')
@section('content')
    <div class="mt-14 p-2">
        <div class="w-full bg-gray-800 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Grups List
                    </h2>
                </div>
                @if ($tim = Session::get('success'))
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <x-uiw-notification class="w-6" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $tim }}</span>;
                        </div>
                    </div>
                @endif
                @if ($tim = Session::get('delete'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <x-uiw-notification class="w-6" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $tim }}</span>;
                        </div>
                    </div>
                @endif


                {{-- content --}}
                <div id="standingManajemen">
                    {{-- grup --}}
                    <div class=" p-2 rounded-lg " id="grup" role="tabpanel">
                        <div class="w-full flex flex-col justify-start items-center mb-2 gap-2">
                            <div class="flex w-full justify-end flex-col">
                                <div class="flex justify-end ">
                                    <button data-modal-target="grup-add" data-modal-toggle="grup-add"
                                        class=" flex flex-row text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-3 py-1.5 md:py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 items-center"
                                        type="button">
                                        <x-uiw-plus class="text-white w-4 md:w-5 font-bold mx-1" />
                                        <span class="font-poppins capitalize">add grup</span>
                                    </button>
                                    <form action="#" method="GET" class="flex flex-row">
                                        @csrf
                                        <div class="flex justify-center">
                                            <div class="flex justify-center mx-2">
                                                <select name="status"
                                                    class="bg-gray-800 text-white p-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                                    <option value="">seasson</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                            <button type="submit"
                                                class="bg-red-600 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                                filter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="w-full flex justify-center ">
                                <table
                                    class="w-full p-0 md:px-6 text-sm text-left rtl:text-righttext-gray-200 rounded-t-full">
                                    <thead class="text-xs uppercase bg-red-700 text-white ">
                                        <tr>
                                            <th scope="col" class="px-3 md:px-6 py-3">
                                                No
                                            </th>
                                            <th scope="col" class="px-3 md:px-6 py-3">
                                                Grup
                                            </th>
                                            <th scope="col" class="px-3 md:px-6 py-3">
                                                Season
                                            </th>
                                            <th scope="col" class="px-3 md:px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($grups as $item)
                                            <tr class=" border-b bg-gray-900 border-gray-700">
                                                <th scope="row" class="px-3 md:px-6 py-4 text-gray-200">
                                                    {{ $i++ }}
                                                </th>
                                                <td
                                                    class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                                    {{ $item->grup }}
                                                </td>
                                                <td
                                                    class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                                    {{ $item->season }}
                                                </td>
                                                <td class="py-4 px-2 md:px-6 flex flex-row gap-2">
                                                    <a href="{{ route('grup.edit', $item->id) }}"
                                                        class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-lg">
                                                        <x-uiw-edit class="w-5" />
                                                    </a>

                                                    <button data-modal-target="grup-delete{{ $item->id }}"
                                                        data-modal-toggle="grup-delete{{ $item->id }}"
                                                        class="font-medium text-white px-2 py-1 rounded-lg bg-red-600 hover:underline">
                                                        <x-uiw-close class="w-5" />
                                                    </button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end content --}}
            </div>
        </div>


        {{-- modal add grup --}}
        <div id="grup-add" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold  text-white capitalize font-kodeMono">
                            Add Grup
                        </h3>
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="grup-add">
                            <x-uiw-close class="w-8" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="flex w-full justify-center items-center p-4">
                        <div class="w-full" x-data="grupAdd()">
                            <form class="space-y-6" method="POST" action="{{ route('grup.store') }}">
                                @csrf
                                <template x-for="(match, index) in matches" :key="index">
                                    <div class="p-4 bg-gray-900 border border-gray-600 rounded-lg space-y-4">
                                        <h3 class="text-lg font-semibold font-kodeMono text-white">
                                            Grup <span x-text="index + 1"></span>
                                        </h3>
                                        <div class="flex md:flex-row gap-2">
                                            <div>
                                                <label :for="'grup-' + index" class="block text-sm font-medium text-white">
                                                    Grup
                                                </label>
                                                <input type="text" :id="'grup-' + index" x-model="match.grup"
                                                    x-bind:name="'matches[' + index + '][grup]'"
                                                    class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
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
                                        Add grup
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

        @foreach ($grups as $item)
            <div id="grup-delete{{ $item->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative  rounded-lg shadow bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-200 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="grup-delete{{ $item->id }}">
                            <x-uiw-close class="w-6" />
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4  w-12 h-12 text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal  text-gray-200">kamu yakin ingin menghapus grup
                                <span class="text-red-600 font-bold font-poppins">{{ $item->grup }}</span> ?
                                kesalahan menghapus grup bisa mengacaukan sistem loo!
                            </h3>
                            <div class="w-full flex justify-center items-center">
                                <form action="{{ route('grup.delete', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        yakin laa &#128539;
                                    </button>
                                </form>
                                <button data-modal-hide="grup-delete{{ $item->id }}" type="button"
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
            function grupAdd() {

                return {
                    matches: [{
                        grup: "",
                    }, ],
                    addMatch() {
                        this.matches.push({
                            grup: "",
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
