@extends('layout.admin')
@section('title', 'Schedule')
@section('content')
    <div class="p-0 md:p-4 mt-14">
        <div class="w-full min-h-screen  rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Schedule List
                    </h2>
                </div>
                @if ($success = Session::get('success'))
                    <div class="flex items-center p-4 mb-4 text-sm  border  rounded-lg  bg-gray-800 text-green-400 border-green-800"
                        role="alert">
                        <x-uiw-notification class="w-6" />
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $success }}</span>
                        </div>
                    </div>
                @endif
                <div class="w-full flex flex-col justify-end items-center mb-2">
                    <div class="flex w-full justify-end flex-col">
                        <div class="flex justify-end  flex-row  gap-4  ">
                            <div class="flex justify-start">
                                <button data-modal-target="schedule-add" data-modal-toggle="schedule-add"
                                    class=" flex flex-row text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-1.5 md:px-3 py-2 md:py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 items-center"
                                    type="button">
                                    <x-uiw-plus class="text-white w-4 md:w-5 font-bold mx-1" />
                                    <span class="font-poppins capitalize">
                                        schedule
                                    </span>
                                </button>
                            </div>
                            <div class="flex justify-start">
                                <button data-modal-target="notification" data-modal-toggle="notification"
                                    class=" flex flex-row text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-1.5 md:px-3 py-2 md:py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 items-center"
                                    type="button">
                                    <x-uiw-bell class="text-white w-4 md:w-5 font-bold mx-1" />
                                    <span class="font-poppins capitalize">
                                        notification
                                    </span>
                                </button>
                            </div>
                            <div class="flex justify-start">
                                <button data-modal-target="filter" data-modal-toggle="filter"
                                    class=" flex flex-row text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-1.5 md:px-3 py-2 md:py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800 items-center"
                                    type="button">
                                    <x-uiw-filter class="text-white w-4 md:w-5 font-bold mx-1" />
                                    <span class="font-poppins capitalize">
                                        filter
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-center items-center gap-2 p-2">
                    @if (!$schedule->isEmpty())
                        @foreach ($schedule as $item)
                             <div class="w-full md:max-w-[320px] flex flex-col border-gray-700 bg-gray-900 shadow-xl shadow-gray-800/100 rounded-xl border-2 py-1 md:py-2">
                                <div class="flex justify-center items-center">
                                    <h1 class="text-red-600 font-poppins font-bold text-[18px] md:text-[24px] uppercase">
                                        day {{ $item->day }}
                                    </h1>
                                </div>
                                        <div class="  flex  flex-row justify-between items-center py-2 px-2 gap-[4px]">
                                            {{-- team 1 --}}
                                            <div class="flex flex-col justify-center items-center max-w-[240px]">
                                                <img src="{{ asset('storage/image/logo/' . $item->logoA) }}" alt="logo "
                                                    class=" w-[64px]  md:w-max-[90px] max-h-[80px]  border-2 border-gray-300 rounded-full object-contain mb-1">
                                                <h2
                                                    class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white ">
                                                    {{ $item->timA }}
                                                </h2>
                                            </div>
                                            {{-- time --}}
                                            <div class="flex flex-row justify-around gap-2 items-center">
                                                <h1 class="font-kodeMono font-extrabold text-red-600 text-4xl md:text-5xl">
                                                    {{ $item->scoreA }}
                                                </h1>
                                                <div class="flex flex-col justify-center items-center p-[1px]">
                                                    <h1 class="text-white font-bold text-[14px] md:text-[12px] truncate text-center">
                                                        {{ (new DateTime($item->time))->format('H:i') }}
                                                    </h1>
                                                    
                                                    <h1 class="text-white font-bold text-[10px] md:text-[12px] truncate text-center">
                                                        {{ (\Carbon\Carbon::parse($item->date)->translatedFormat('l')) }},
                                                        {{ (\Carbon\Carbon::parse($item->date)->translatedFormat('d F ')) }}
                                                    </h1>
                                                </div>
                                                <h1 class="font-kodeMono font-extrabold text-red-600 text-4xl md:text-5xl">
                                                    {{ $item->scoreB }}
                                                </h1>
                                            </div>
                                            {{-- team 2 --}}
                                            <div class="flex flex-col justify-center items-center max-w-[240px]">
                                                <img src="{{ asset('storage/image/logo/' . $item->logoB) }}" alt="logo "
                                                    class=" w-[64px]  md:w-max-[90px] max-h-[80px] border-2 border-gray-300 rounded-full object-contain mb-1">
                                                <h2
                                                    class="font-kodeMono font-bold text-[16px] md:text-[18px] text-center uppercase text-white ">
                                                    {{ $item->timB }}
                                                </h2>
                                            </div>
                                            {{-- end of one match --}}
                                            
                                        </div>
                                         <div class="flex flex-row justify-start gap-2 items-center px-3">
                                    <a type="button" href="{{ route('schedule.edit', $item->id) }}"
                                        class=" text-white  focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-3 py-1.5 md:py-2 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                        <x-uiw-edit class="w-4 md:w-5" />
                                    </a>
                                    <button data-modal-target="schedule-delete{{ $item->id }}"
                                        data-modal-toggle="schedule-delete{{ $item->id }}" type="button"
                                        class=" text-white  focus:ring-4 focus:outline-none font-poppins  font-medium rounded-lg text-sm px-3 py-1.5 md:py-2 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">
                                        <x-uiw-delete class="w-4 md:w-5" />
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center text-sm md:text-lg text-gray-300 font-semibold">
                            Tidak ada jadwal pertindingan.
                        </h3>
                    @endif
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <ul class="inline-flex items-stretch -space-x-px text-white ">
                        {{ $schedule->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal toggle -->


    <!-- Main modal -->

    {{-- modal add --}}
    <div id="schedule-add" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-xl font-semibold  text-white capitalize font-kodeMono">
                        Add Schedule
                    </h3>
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                        data-modal-hide="schedule-add">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="flex w-full justify-center items-center p-4">
                    <div class="w-full" x-data="scheduleAdd()">
                        <form class="space-y-6" method="POST" action="{{ route('schedule.store') }}">
                            @csrf
                            <template x-for="(match, index) in matches" :key="index">
                                <div class="p-4 bg-gray-900 border border-gray-600 rounded-lg space-y-4">
                                    <h3 class="text-lg font-semibold font-kodeMono text-white">Match <span
                                            x-text="index + 1"></span></h3>
                                    <!-- Tim A -->
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label :for="'timA-' + index" class="block text-sm font-medium text-white">Tim
                                                A</label>
                                            <select :id="'timA-' + index" x-model="match.timA"
                                                x-bind:name="'matches[' + index + '][timA]'"
                                                class=" border   text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="" disabled selected>Pilih Tim A</option>
                                                @foreach ($squads as $item)
                                                    <option value="{{ $item->id }}">{{ $item->squad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tim B -->
                                    <div class="flex md:flex-row gap-2">
                                        <div class="w-full">
                                            <label :for="'timB-' + index" class="block text-sm font-medium text-white">Tim
                                                B</label>
                                            <select :id="'timB-' + index" x-model="match.timB"
                                                x-bind:name="'matches[' + index + '][timB]'"
                                                class="border   text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="" disabled selected>Pilih Tim B</option>
                                                @foreach ($squads as $item)
                                                    <option value="{{ $item->id }}">{{ $item->squad }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <!-- Time -->
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div class="w-full">
                                            <label :for="'day-' + index" class="block text-sm font-medium text-white">
                                                Day
                                            </label>
                                            <input type="number" :id="'day-' + index" x-model="match.day"
                                                x-bind:name="'matches[' + index + '][day]'"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                        </div>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <div class="w-full">
                                            <label :for="'time-' + index" class="block text-sm font-medium text-white">
                                                Time
                                            </label>
                                            <input type="time" :id="'time-' + index" x-model="match.time"
                                                x-bind:name="'matches[' + index + '][time]'"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                        </div>
                                        <div class="w-full">
                                            <label :for="'date-' + index" class="block text-sm font-medium text-white">
                                                Date
                                            </label>
                                            <input type="date" :id="'date-' + index" x-model="match.date"
                                                x-bind:name="'matches[' + index + '][date]'"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                        </div>
                                    </div>


                                    <!-- Remove Match -->
                                    <button type="button" @click="removeMatch(index)"
                                        class="text-white hover:bg-red-700 text-sm mt-2 bg-red-600 p-2 rounded-xl">
                                        Remove
                                    </button>

                            </template>

                            <div class="flex justify-between">
                                <button type="button" @click="addMatch"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Match
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

    @foreach ($schedule as $item)
        <div id="schedule-delete{{ $item->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative  rounded-lg shadow bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                        data-modal-hide="schedule-delete{{ $item->id }}">
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
                        <h3 class="mb-5 text-lg font-normal  text-gray-400">Kamu yakin ingin menghapus match
                            <span class="text-red-500 font-bold font-poppins">{{ $item->timA }}</span> vs
                            <span class="text-red-500 font-bold font-poppins">{{ $item->timB }}</span> di hari
                            ke-{{ $item->day }}?
                        </h3>
                        <div class="w-full flex justify-center items-center">
                            <form action="{{ route('schedule.delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    yakin &#128539;
                                </button>
                            </form>
                            <button data-modal-hide="schedule-delete{{ $item->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  rounded-lg border focus:z-10 focus:ring-4  focus:ring-gray-700 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">
                                ngga jadi deh &#128549;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal filter --}}
    <div id="filter" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative  rounded-lg shadow bg-gray-800">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="filter">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center p-4">
                        <x-uiw-filter class="w-12 h-12 text-center text-white font-bold" />
                    </div>
                    <form action="{{ route('schedule.admin') }}" method="GET">
                        <div class="flex justify-end md:flex-row flex-col gap-2 md:gap-0">
                            <div class="flex justify-start flex-col mx-0 md:mx-2 w-full">
                                <label label="No. Whatsapp" class="block mb-2 text-sm font-medium text-white capitalize">
                                    Tim
                                </label>
                                <select name="tim"
                                    class="bg-gray-900 text-white p-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent w-full">
                                    <option value="">tim</option>
                                    @foreach ($squads as $item)
                                        <option value="{{ $item->squad }}">{{ $item->squad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-start flex-col mx-0 md:mx-2">
                                <label label="No. Whatsapp" class="block mb-2 text-sm font-medium text-white capitalize">
                                    Day
                                </label>
                                <select name="day"
                                    class="bg-gray-900 text-white p-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent w-full md:w-auto">
                                    <option value="">day</option>
                                    @for ($i = 1; $i < 11; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="w-full flex justify-end items-center py-4 gap-2">
                            <button type="submit"
                                class="bg-red-600 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                filter
                            </button>
                            <button data-modal-hide="filter" type="button"
                                class="bg-gray-900 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal notification --}}
    <div id="notification" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative  rounded-lg shadow bg-gray-800">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="notification">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center p-4">
                        <x-uiw-bell class="w-12 h-12 text-center text-white font-bold" />
                    </div>
                    <form action="{{ route('schedule.notification') }}" method="post">
                        @csrf
                        <div class="flex justify-start md:flex-row gap-2 md:gap-0">
                            <div class="flex justify-start flex-col mx-0 md:mx-2 w-full">
                                <label label="No. Whatsapp" class="block mb-2 text-sm font-medium text-white capitalize">
                                    Day
                                </label>
                                <select name="day"
                                    class="bg-gray-900 text-white p-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent w-full md:w-auto">
                                    <option value="">day</option>
                                    @for ($i = 1; $i < 11; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="flex justify-start flex-col mx-0 md:mx-2 w-full">
                                <label label="No. Whatsapp" class="block mb-2 text-sm font-medium text-white capitalize">
                                    Time
                                </label>
                                <input type="time" name="time"
                                    class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-900 border-gray-800 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                            </div>

                        </div>
                        <div class="w-full flex justify-end items-center py-4 gap-2">
                            <button type="submit"
                                class="bg-red-600 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                Notification
                            </button>
                            <button data-modal-hide="notification" type="button"
                                class="bg-gray-900 text-white p-2 rounded-md focus:outline-focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function scheduleAdd() {

            return {
                status: ["win", "lose"],
                matches: [{
                    timA: "",
                    timB: "",
                    day: "",
                    time: "",
                    date: "",
                }, ],
                addMatch() {
                    this.matches.push({
                        timA: "",
                        timB: "",
                        day: "",
                        time: "",
                        date: "",
                    });
                },
                removeMatch(index) {
                    this.matches.splice(index, 1);
                },

                closeModal() {
                    // Add logic to close modal if integrated into a larger system
                },
            };
        }
    </script>

@endsection
