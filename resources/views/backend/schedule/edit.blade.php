@extends('layout.admin')
@section('title', 'Schedule')
@section('content')
    <div class="p-4 mt-14">
        <div class="w-full rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        edit macth
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-center gap-2 p-2">
                    <div class="flex w-full justify-center items-center ">
                        <div class="w-full">
                            <form method="POST" action="{{ route('schedule.update', $schedule->id) }}">
                                @csrf
                                @method('put')
                                <div class="p-4 border border-white border-dotted rounded-lg space-y-4">
                                    <div
                                        class="flex flex-col md:flex-row justify-between md:justify-start text-[38px] font-semibold font-kodeMono text-white items-center gap-0 md:gap-2">
                                        <h1>
                                            Match
                                        </h1>
                                        <h1 class="text-red-600">
                                            {{ $schedule->timA }}
                                        </h1>
                                        <h1>
                                            vs
                                        </h1>
                                        <h1 class="text-blue-600">
                                            {{ $schedule->timB }}

                                        </h1>
                                    </div>

                                    <!-- Tim A -->
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div>
                                            <label class="block text-sm font-medium text-white">Tim
                                                A</label>
                                            <select name="id_timA" disabled
                                                class="border   text-sm rounded-lg   block w-full p-2.5 bg-blue-700 border-blue-600 placeholder-blue-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="{{ $schedule->id_timA }}" selected>
                                                    {{ $schedule->timA }}
                                                </option>
                                                @error('id_timA')
                                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                        {{ $message }}</p>
                                                @enderror
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Score A
                                            </label>
                                            <input type="number" name="scoreA" value="{{ $schedule->scoreA }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('scoreA')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                status A
                                            </label>
                                            <select name="statusA" id="statusA"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">--status A --</option>
                                                @foreach ($status as $item)
                                                    <option value="{{ $item['value'] }}" class="capitalize">
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('statusA')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tim B -->
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Tim B
                                            </label>
                                            <select name="id_timB" disabled
                                                class="border   text-sm rounded-lg   block w-full p-2.5 bg-red-700 border-red-600 placeholder-red-900 text-white focus:ring-red-500 focus:border-red-500 ">

                                                <option value="{{ $schedule->id_timB }}" selected>
                                                    {{ $schedule->timB }}
                                                </option>
                                                @error('id_timB')
                                                    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                        {{ $message }}</p>
                                                @enderror
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Score B
                                            </label>
                                            <input type="number" name="scoreB" value="{{ $schedule->scoreB }}"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('scoreB')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                status B
                                            </label>
                                            <select name="statusB" id="statusB"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">--status B --</option>
                                                @foreach ($status as $item)
                                                    <option value="{{ $item['value'] }}" class="capitalize">
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('statusB')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Time -->
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Day
                                            </label>
                                            <input type="text" value="{{ $schedule->day }}" name="day"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('day')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Time
                                            </label>
                                            <input type="time" value="{{ $schedule->time }}" name="time"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('time')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-white">
                                                Date
                                            </label>
                                            <input type="date" value="{{ $schedule->date }}" name="date"
                                                class="border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('date')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between ">
                                        <button type="submit"
                                            class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                                            update
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            @endsection
