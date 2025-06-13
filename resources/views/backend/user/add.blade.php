@extends('layout.admin')
@section('title', 'user')
@section('content')
    <div class="p-4 mt-14">
        <div class="w-full rounded-3xl">
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-poppins uppercase text-[18px] font-bold text-white">
                        Add User
                    </h2>
                </div>
                <div class="w-full flex flex-wrap flex-col md:flex-row justify-start gap-2 p-2">
                    <div class="flex w-full justify-center items-center ">
                        <div class="w-full">
                            <form method="POST" action="{{ route('user.store') }}">
                                @csrf
                                <div class="p-4 bg-gray-900 border border-gray-600 rounded-lg space-y-4">
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">Username</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('username')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">
                                                Role
                                            </label>
                                            <select name="role" id="role"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Role</option>
                                                <option value="admin">admin</option>
                                                <option value="peserta">peserta</option>
                                            </select>
                                            @error('role')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <div class="hidden w-full" id="tim-container">
                                            <label class="block text-sm font-medium text-white">Tim</label>
                                            <select name="tim_id" id="tim_id"
                                                class="w-full  border   text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Tim</option>
                                                @foreach ($tim as $item)
                                                    <option value="{{ $item->id }}">{{ $item->squad }}</option>
                                                @endforeach
                                            </select>
                                            @error('tim_id')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-white">password</label>
                                            <input type="password" name="password"
                                                class="border w-full  text-sm rounded-lg  block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light">
                                            @error('password')
                                                <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between ">
                                        <button type="submit"
                                            class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800">
                                            Add
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    document.addEventListener("DOMContentLoaded", function(){
        const timContainer = document.getElementById('tim-container');
        const role = document.getElementById('role');

        role.addEventListener("change", function() {
            if(this.value === "peserta"){
                timContainer.classList.remove("hidden");
            } else{
                timContainer.classList.add("hidden");
            }
        })

    })
</script>

@endsection
