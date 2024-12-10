@extends('layout.admin')
@section('title', 'Tim')
@section('content')
    <div class="md:p-4 mt-14">
        <section class="bg-gray-800 w-full p-1 sm:p-5">
            <h1 class="text-white font-poppins text-[24px] border-x-black border-b-2 uppercase font-bold">
                Tim List
            </h1>
            <div class="w-full px-1">
                <div class="bg-gray-800  relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/3">
                            <form class="flex items-center" method="GET" action="{{ route('tim') }}">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <x-uiw-search class="w-5 h-5 text-gray-500 " />
                                    </div>
                                    <input type="text" id="search" value="{{ request('search') }}" name="search"
                                        class="bg-gray-900 border border-gray-600 text-white text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2   placeholder-gray-500   "
                                        placeholder="cari tim...">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="overflow-x-auto p-1 bg-gray-900">
                        @if ($update = Session::get('update'))
                            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                                role="alert">
                                <x-uiw-notification class="w-6" />
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">{{ $update }}</span> berhasil diupdate;
                                </div>
                            </div>
                        @endif
                        @if ($delete = Session::get('delete'))
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                                role="alert">
                                <x-uiw-notification class="w-6" />
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">{{ $delete }}</span> berhasil dihapus;
                                </div>
                            </div>
                        @endif
                        <table class="w-full text-sm text-left text-gray-500 overflow-x-auto">
                            <thead class="text-xs uppercase bg-red-700 text-white">
                                <tr>
                                    <th scope="col" class="px-3  py-3">
                                        Team
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        No Whatsapp
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        Season
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tim as $item)
                                    <tr class=" border-b bg-gray-900 border-gray-700">
                                        <td class="px-3  py-4 font-medium  uppercase whitespace-wrap text-white">
                                            {{ $item->squad }}
                                        </td>
                                        <td class="px-3  py-4 font-medium  uppercase whitespace-wrap text-white">
                                            {{ $item->no_whatsapp }}

                                        </td>
                                        <td class="px-3  py-4 whitespace-wrap text-white">
                                            {{ $item->season }}
                                        </td>
                                        <td class="py-4 px-1 md:px-2  flex flex-row ">
                                            <button data-modal-target="tim-view{{ $item->id }}"
                                                data-modal-toggle="tim-view{{ $item->id }}"
                                                class="font-medium text-white bg-green-500 hover:underline px-2 py-1 rounded-3xl">
                                                <x-uiw-eye class="w-5" />
                                            </button>
                                            <a href="{{ route('tim.edit', $item->id) }}"
                                                class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-3xl ml-2">
                                                <x-uiw-edit class="w-5" />
                                            </a>
                                            <button data-modal-target="tim-delete{{ $item->id }}"
                                                data-modal-toggle="tim-delete{{ $item->id }}"
                                                class="font-medium text-white px-2 py-1 rounded-3xl bg-red-600 hover:underline ml-2">
                                                <x-uiw-delete class="w-5" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation">
                        <ul class="inline-flex items-stretch -space-x-px text-white ">
                            {{ $tim->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal toggle -->


    <!-- Main modal -->
    @foreach ($tim as $item)
        <div id="tim-view{{ $item->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold  text-white capitalize font-kodeMono">
                            {{ $item->squad }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="tim-view{{ $item->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="w-full flex justify-center">
                            <table class="w-full px-4 text-sm text-left rtl:text-righttext-gray-400 rounded-t-full">
                                <tbody>
                                    <tr class=" border-b bg-gray-800 border-gray-700 ">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Logo
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  whitespace-nowrap text-white">
                                            <img src="{{ asset('storage/image/logo/' . $item->logo) }}" alt="logo tim"
                                                class="w-[120px] object-contain rounded-full">
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Ketua
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->leader }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Nomor Whatsapp
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->no_whatsapp }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Squad
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->squad }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Short Squad
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->short_squad }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            nickname Player 1
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->nickname1 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Id Player 1
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->id_nickname1 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            nickname Player 2
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->nickname2 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Id Player 2
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->id_nickname2 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            nickname Player 3
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->nickname3 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Id Player 3
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->id_nickname3 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            nickname Player 4
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->nickname4 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Id Player 4
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->id_nickname4 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            nickname Player 5
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->nickname5 }}
                                        </td>
                                    </tr>
                                    <tr class=" border-b bg-gray-800 border-gray-700">
                                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                            Id Player 5
                                        </th>
                                        <td class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                            {{ $item->id_nickname5 }}
                                        </td>
                                    </tr>
                                    @if (!empty($item->nickname6))
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                                nickname Player 6
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                                {{ $item->nickname6 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                                                Id Player 6
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  capitalize whitespace-nowrap text-white">
                                                {{ $item->id_nickname6 }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($tim as $tims)
        <div id="tim-delete{{ $tims->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative  rounded-lg shadow bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                        data-modal-hide="tim-delete{{ $tims->id }}">
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
                        <h3 class="mb-5 text-lg font-normal  text-gray-400">kamu yakin ingin menghapus tim <span
                                class="text-red-500 font-bold font-poppins">{{ $tims->squad }}</span> &#128529; ?
                        </h3>
                        <div class="w-full flex justify-center items-center">
                            <form action="{{ route('tim.delete', ['id' => $tims->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    yakin laaa &#128539;
                                </button>
                            </form>
                            <button data-modal-hide="tim-delete{{ $tims->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  rounded-lg border focus:z-10 focus:ring-4  focus:ring-gray-700 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">
                                nggak jadi deh &#128549;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
