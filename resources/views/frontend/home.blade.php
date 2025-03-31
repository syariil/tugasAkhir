@extends('layout.user')
@section('title', 'Kabaena Cup')
@section('content')



    @if ($banner != null)
        <div class="w-full h-auto flex justify-center items-center p-4 mt-14">
            <img src="{{ asset('storage/image/banner/' . $banner[0]->banner) }}" alt="banner"
                class="w-full md:w-[1080px] h-auto md:max-h-[720px] object-content shadow-2xl shadow-gray-700">
        </div>
    @else
        <div class="w-full h-auto flex justify-center items-center p-4 mt-14">
            <img src="{{ asset('storage/image/banner/logo.png') }}" alt="banner"
                class="w-screen max-h-[680px] object-content shadow-2xl shadow-gray-700">
        </div>
    @endif

    <div class="w-full flex flex-col justify-center content-center items-center mb-2 md:mb-9 ">
        @if ($highlight != null)
            <x-heading name="Highlight" margin="2" />
            <div class="flex flex-col md:flex-row justify-center w-full gap-2 my-2 md:my-0 ">
                <a href="{{ $highlight[0]->url }}">
                    <div
                        class="max-w-[640px] max-h-[360px] flex flex-col justify-start  bg-gray-700 rounded-xl p-4 hover:bg-gray-800">
                        <img src="{{ asset('storage/image/thumbnail/' . $highlight[0]->thumbnail) }}" alt="thumbnail"
                            class="w-full h-[195px] object-cover rounded-xl items-center">
                        <h1 class="font-poppins text-[16px] font-bold text-gray-300 capitalize">
                            {{ $highlight[0]->judul }}
                        </h1>
                    </div>
                </a>
                <div
                    class="flex flex-col justify-start bg-gray-800 rounded-xl max-w-[507px] max-h-[320px] overflow-auto scroll-smooth snap-y snap-mandatory p-2">
                    @foreach ($highlight as $item)
                        <a href="{{ $item->url }}">
                            <div
                                class="w-full flex flex-row justify-start bg-gray-700 my-1 py-1 rounded-lg snap-always border border-gray-700 ">
                                <img src="{{ asset('storage/image/thumbnail/' . $item->thumbnail) }}" alt="thumbnail news"
                                    class="w-[88px] h-[70px] object-contain rounded-lg">
                                <div class="w-[90%] flex flex-col justify-start h-[70px]">
                                    <h1 class="font-poppins text-[15px] font-bold text-gray-300 capitalize">
                                        {{ $item->judul }}
                                    </h1>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>



@endsection
