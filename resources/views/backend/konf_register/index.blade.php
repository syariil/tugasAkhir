@extends('layout.admin')
@section('title', 'registration')
@section('content')
    <div class="p-4 mt-14">
        <section class="w-full  p-1 sm:p-5 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Registration List
                    </h2>
                </div>
                <div class="w-full px-1">
                    <div class="bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
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
                        <div class="overflow-x-auto p-1 bg-gray-900">
                            <table class="w-full  text-sm text-left rounded-t-full text-gray-500 overflow-x-auto">
                                <thead class="text-xs uppercase bg-red-700 text-white ">
                                    <tr>

                                        <th scope="col" class="px-3 md:px-6 py-3">
                                            Team
                                        </th>
                                        <th scope="col" class="px-3 md:px-6 py-3">
                                            No Wahtsapp
                                        </th>
                                        <th scope="col" class="px-3 md:px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $tim)
                                        <tr class=" border-b bg-gray-900 border-gray-700">
                                            <td
                                                class="px-2 md:px-6 py-4 font-light md:font-medium  capitalize whitespace-nowrap text-white">
                                                {{ $tim->squad }}
                                            </td>
                                            <td
                                                class="px-2 md:px-6 py-4 font-light md:font-medium  capitalize whitespace-nowrap text-white">
                                                {{ $tim->no_whatsapp }}
                                            </td>
                                            <td
                                                class="py-4 px-1 md:px-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                                                <button data-modal-target="tim-view{{ $tim->id }}"
                                                    data-modal-toggle="tim-view{{ $tim->id }}"
                                                    class="font-medium text-white bg-green-500 hover:underline px-2 py-1 rounded-lg">
                                                    <x-uiw-eye class="w-5" />
                                                </button>
                                                <button data-modal-target="tim-aprove{{ $tim->id }}"
                                                    data-modal-toggle="tim-aprove{{ $tim->id }}"
                                                    class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-lg">
                                                    <x-uiw-circle-check class="w-5" />
                                                </button>

                                                <button data-modal-target="tim-delete{{ $tim->id }}"
                                                    data-modal-toggle="tim-delete{{ $tim->id }}"
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
        </section>

        @foreach ($data as $tim)
            <div id="tim-view{{ $tim->id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                            <h3 class="text-xl font-semibold  text-white capitalize font-kodeMono">
                                {{ $tim->squad }}
                            </h3>
                            <button type="button"
                                class="text-gray-200 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                data-modal-hide="tim-view{{ $tim->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <div class="w-full flex justify-center">
                                <table class="w-full px-4 text-sm text-left rtl:text-righttext-gray-200 rounded-t-full">
                                    <tbody>
                                        <tr class=" border-b bg-gray-800 border-gray-700 ">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                Logo
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                <img src="{{ asset('storage/image/logo/' . $tim->logo) }}" alt="logo tim"
                                                    class="w-[120px]  rounded-full">
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                Ketua
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->leader }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                Nomor Whatsapp
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->no_whatsapp }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                squad
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->squad }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                Short Squad
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->short_squad }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                Fee
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                <img src="{{ asset('storage/image/fee/' . $tim->fee) }}" alt="logo tim"
                                                    class="w-[320px]">
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                nickname player1
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->nickname1 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                id player1
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->id_nickname1 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                nickname player2
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->nickname2 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                id player2
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->id_nickname2 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                nickname player3
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->nickname3 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                id player3
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->id_nickname3 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                nickname player4
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->nickname4 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                id player4
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->id_nickname4 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                nickname player5
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->nickname5 }}
                                            </td>
                                        </tr>
                                        <tr class=" border-b bg-gray-800 border-gray-700">
                                            <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                id player5
                                            </th>
                                            <td
                                                class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                {{ $tim->id_nickname5 }}
                                            </td>
                                        </tr>
                                        @if (!empty($tim->nickname6))
                                            <tr class=" border-b bg-gray-800 border-gray-700">
                                                <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                    nickname player6
                                                </th>
                                                <td
                                                    class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                    {{ $tim->nickname6 }}
                                                </td>
                                            </tr>
                                            <tr class=" border-b bg-gray-800 border-gray-700">
                                                <th scope="row" class="px-3 md:px-3 py-2 text-gray-200">
                                                    id player6
                                                </th>
                                                <td
                                                    class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                                                    {{ $tim->id_nickname6 }}
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

        @foreach ($data as $tim)
            <div id="tim-aprove{{ $tim->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative  rounded-lg shadow bg-gray-800">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-200 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="tim-aprove{{ $tim->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4  w-12 h-12 text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal  text-gray-200">kamu yakin menyetujui pendaftaran tim <span
                                    class="text-white font-bold font-poppins">{{ $tim->squad }}</span> ?
                            </h3>
                            <div class="w-full flex justify-center items-center">
                                <form action="{{ route('uprove.registration', ['id' => $tim->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        yakin laa &#128539;
                                    </button>
                                </form>
                                <button data-modal-hide="tim-aprove{{ $tim->id }}" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  rounded-lg border focus:z-10 focus:ring-4  focus:ring-gray-700 bg-gray-800 text-gray-200 border-gray-600 hover:text-white hover:bg-gray-700">
                                    ngga yakin sih &#128549;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($data as $tim)
            <div id="tim-delete{{ $tim->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative  rounded-lg shadow bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-200 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="tim-delete{{ $tim->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4  w-12 h-12 text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal  text-gray-200">kamu yakin tidak menerima pendaftaran tim
                                <span class="text-red-600 font-bold font-poppins">{{ $tim->squad }}</span> ?
                            </h3>
                            <div class="w-full flex justify-center items-center">
                                <form action="{{ route('delete.registration', ['id' => $tim->id]) }}" method="POST">
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
