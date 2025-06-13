@extends('layout.admin')
@section('title', 'profile')
@section('content')
    <section class="flex flex-col justify-center items-center relative py-4 mt-14 px-6">
        <div class="flex flex-col justify-center   w-full  rounded-3xl">
            @if ($message = Session::get('success'))
                <div class="flex justify-center py-4 my-4">
                    <div class="text-[16px] text-gray-700 uppercase bg-green-500 rounded-3xl">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            @elseif($message = Session::get('error'))
                <div class="flex justify-center py-4 my-4">
                    <div class="text-[16px] text-gray-700 uppercase bg-red-500 rounded-3xl">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            @endif
            <div class="w-full flex flex-col items-center my-4">
                <h2 class="font-poppins font-semibold text-[32px]  text-gray-100 align-middle">
                    {{ Auth::user()->username }}
                </h2>
            </div>

            <div class="w-full flex  flex-col my-4 ml-2 md:ml-4">
                <form action=" {{ route('profile.changePassowrd') }} " method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium  text-white">Old Password</label>
                        <input type="password" name="old_password" id="password" placeholder="••••••••"
                            class=" bg-gray-900 border  border-gray-700  text-gray-100 text-[18px] md:text-[24px] rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] md:w-[50%] p-2.5"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium  text-white">New Password</label>
                        <input type="password" name="new_password" id="password" placeholder="••••••••"
                            class=" bg-gray-900 border  border-gray-700  text-gray-100 text-[18px] md:text-[24px] rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] md:w-[50%] p-2.5"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium  text-white">Confirm
                            password</label>
                        <input type="password" name="confirmed" id="password" placeholder="••••••••"
                            class=" bg-gray-900 border  border-gray-700  text-gray-100 text-[18px] md:text-[24px] rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] md:w-[50%] p-2.5"
                            required>
                    </div>
                    <div class="">
                        @if ($errors->any())
                            <div class="flex justify-start">
                                <div class="text-[16px] text-gray-50 uppercase bg-red-500 rounded-sm my-2">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mb-2">
                        <button type="submit"
                            class="px-4 py-3 font-poppins font-semibold text-white text-[18px] bg-blue-600 capitalize rounded-xl">
                            change
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection
