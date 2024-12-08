@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="p-0 mt-14">
        <div class="w-full bg-gray-800 rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Tim List
                    </h2>
                </div>
                <div class="w-full flex flex-col justify-end items-center mb-2">
                    <div class="flex w-full justify-end flex-col">
                        <div class="flex justify-end ">
                            <form action="#" method="GET" class="flex flex-row">
                                @csrf
                                <div class="flex justify-center">
                                    <div class="flex justify-center mx-2">
                                        <select name="status"
                                            class="bg-gray-800 text-white p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                            <option value="">Select season</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="bg-red-600 text-white p-2 rounded-md
                                    focus:outline-none focus:ring-2 focus:ring-gray-200
                                    focus:border-transparent">filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <table class="w-full p-0 md:px-6 text-sm text-left rtl:text-righttext-gray-400 rounded-t-full">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-300 ">
                            <thead class="text-xs uppercase bg-gray-700 text-gray-300 ">
                                <tr>
                                    <th scope="col" class="px-3 md:px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-3 md:px-6 py-3">
                                        name
                                    </th>
                                    <th scope="col" class="px-3 md:px-6 py-3">
                                        description
                                    </th>
                                    <th scope="col" class="px-3 md:px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($tim as $item)
                                <tr class=" border-b bg-gray-800 border-gray-700">
                                    <th scope="row" class="px-3 md:px-6 py-4 text-gray-400">
                                        {{ $i }}
                                    </th>
                                    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 text-white">
                                        {{ $item->description }}
                                    </td>
                                    <td class="py-4 px-2 md:px-6 flex flex-row ">
                                        <button class="btn-view bg-blue-500 text-white px-4 py-2"
                                            data-url="{{ route('test.view', $item->id) }}">View</button>
                                        <button class="btn-edit bg-green-500 text-white px-4 py-2"
                                            data-url="{{ route('test.edit', $item->id) }}">Update</button>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('partials.modal')
        {{-- <div class="container mx-auto p-4" x-data="{ fields: [{ name: '', value: '' }], showModal: false }"> <button @click="showModal = true"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Open Form</button>
            <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <h2 class="text-xl font-bold mb-4">Dynamic Form</h2>
                        <form action="/dynamic-form" method="POST"> @csrf <template x-for="(field, index) in fields"
                                :key="index">
                                <div class="mb-4"> <label class="block text-gray-700 text-sm font-bold mb-2">Field
                                        Name</label> <input type="text" name="fields[][name]" x-model="field.name"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Field Value</label> <input
                                        type="text" name="fields[][value]" x-model="field.value"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <button type="button" @click="fields.splice(index, 1)"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">Remove</button>
                                </div>
                            </template> <button type="button" @click="fields.push({ name: '', value: '' })"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Field</button> <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button>
                        </form> <button @click="showModal = false"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4">Close</button>
                    </div>
                </div>
            </div> --}}

    </div>
@endsection
