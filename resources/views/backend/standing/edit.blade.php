@extends('layout.admin')
@section('title', 'standings')
@section('content')
    <div class="p-4 mt-14">
        <div class="w-full bg-gray-800 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        grup {{ $grup[0]->grup }}
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
                <div class="w-full flex justify-center">
                    <table class="w-full p-0 md:px-6 text-sm text-left rtl:text-righttext-gray-200 rounded-t-full">
                        <thead class="text-xs uppercase bg-red-700 text-white ">
                            <tr>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Team
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Win
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Lose
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Winrate(%)
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Poin
                                </th>
                                <th scope="col" class="px-3 md:px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($grup as $item)
                                <tr class=" border-b bg-gray-900 border-gray-700">
                                    <th scope="row" class="px-3 md:px-6 py-4 text-gray-200">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->squad }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->win }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->lose }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->winrate }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->poin }}
                                    </td>
                                    <td class="py-4 px-2 md:px-6 flex flex-row gap-2">
                                        <a href="{{ route('standing.editStanding', $item->id) }}"
                                            class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-3xl">
                                            <x-uiw-edit class="w-5" />
                                        </a>

                                        <button data-modal-target="tim-delete{{ $item->id }}"
                                            data-modal-toggle="tim-delete{{ $item->id }}"
                                            class="font-medium text-white px-2 py-1 rounded-3xl bg-red-600 hover:underline">
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


        @foreach ($grup as $tim)
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
                                <span class="text-red-600 font-bold font-poppins">{{ $tim->squad }} </span> di grup
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

    </div>



@endsection
