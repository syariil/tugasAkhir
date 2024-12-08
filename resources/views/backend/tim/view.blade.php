@extends('layout.admin')
@section('title', 'nama tim')
@section('content')
    <div class="p-4 mt-14">
        <x-heading name="Nama Tim" margin="2" />


        <div class="w-full md:w-[50%] flex justify-center items-center">
            <table class="w-full md:w-[50%] px-4 text-sm text-left rtl:text-righttext-gray-400 rounded-t-full">
                <tbody>
                    <tr class=" border-b bg-gray-800 border-gray-700 ">
                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                            Logo
                        </th>
                        <td class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                            <img src="{{ url('image/logo.png') }}" alt="logo tim" class="w-12 rounded-full">
                        </td>
                    </tr>
                    <tr class=" border-b bg-gray-800 border-gray-700">
                        <th scope="row" class="px-3 md:px-3 py-2 text-gray-400">
                            Ketua
                        </th>
                        <td class="px-3 md:px-3 py-2 font-medium  uppercase whitespace-nowrap text-white">
                            Nasrin
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    </div>

@endsection
