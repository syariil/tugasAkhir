@extends('layout.admin')
@section('title', 'highlight')
@section('content')
    <div class="p-4 mt-14">
        <section class="bg-gray-800 w-full p-1 sm:p-5">
            <h1 class="text-white font-poppins text-[24px] border-x-black border-b-2 uppercase font-bold">
                Highlight
            </h1>
            <div class="w-full px-1">
                <div class="bg-gray-800  relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/3">
                            <form class="flex items-center" method="GET" action="{{ route('highlight.index') }}">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <x-uiw-search class="w-5 h-5 text-gray-500 " />
                                    </div>
                                    <input type="text" id="search" value="{{ request('search') }}" name="search"
                                        class="bg-gray-900 border border-gray-600 text-white text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2   placeholder-gray-500   "
                                        placeholder="cari judul...">
                                </div>
                            </form>
                        </div>
                        <div
                            class="w-full md:w-auto flex flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <a href="{{ route('highlight.add') }}"
                                class="flex items-center justify-center text-white bg-blue-500  hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2  focus:outline-none gap-1">
                                <x-uiw-plus class="w-4" />
                                Highlight
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto p-1 bg-gray-900">
                        @if ($update = Session::get('success'))
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                                role="alert">
                                <x-uiw-notification class="w-6" />
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">{{ $update }}</span>
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
                                    <th scope="col" class="px-1 md:px-3 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        judul
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        thumbnail
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        url
                                    </th>
                                    <th scope="col" class="px-3  py-3">
                                        Action
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($highlight as $item)
                                    <tr class=" border-b bg-gray-900 border-gray-700">
                                        <th scope="row" class="px-3  py-4 text-gray-400">
                                            {{ $i }}
                                        </th>
                                        <td class="px-3  py-4 font-medium  uppercase whitespace-wrap text-white">
                                            {{ $item->judul }}
                                        </td>
                                        <td class="px-3  py-4 font-medium  uppercase whitespace-wrap text-white">
                                            {{ $item->thumbnail }}

                                        </td>
                                        <td class="px-3  py-4 whitespace-wrap text-white">
                                            {{ $item->url }}
                                        </td>
                                        <td class="py-4 px-2  flex flex-row ">
                                            <a href="{{ route('highlight.edit', $item->id) }}"
                                                class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-3xl ml-2">
                                                <x-uiw-edit class="w-5" />
                                            </a>
                                            <button data-modal-target="highlight-delete{{ $item->id }}"
                                                data-modal-toggle="highlight-delete{{ $item->id }}"
                                                class="font-medium text-white px-2 py-1 rounded-3xl bg-red-600 hover:underline ml-2">
                                                <x-uiw-delete class="w-5" />
                                            </button>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation">
                        <ul class="inline-flex items-stretch -space-x-px text-white ">
                            {{ $highlight->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal toggle -->
    @foreach ($highlight as $item)
        <div id="highlight-delete{{ $item->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative  rounded-lg shadow bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                        data-modal-hide="highlight-delete{{ $item->id }}">
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
                        <h3 class="mb-5 text-lg font-normal  text-gray-400">kamu yakin ingin menghapus Highlight <span
                                class="text-red-500 font-bold font-poppins">{{ $item->judul }}</span> &#128529; ?
                        </h3>
                        <div class="w-full flex justify-center items-center">
                            <form action="{{ route('highlight.delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    yakin laaa &#128539;
                                </button>
                            </form>
                            <button data-modal-hide="highlight-delete{{ $item->id }}" type="button"
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
