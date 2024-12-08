<div class="md:mb-3 mb-5">
    <label label="{{ $title }}" class="block mb-2 text-sm font-medium text-white capitalize">
        {{ $title }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}"
        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
        placeholder="{{ $placeholder }}" />
    <p class="mt-1 text-xs font-extrabold text-red-500 font-poppins"> {{ $message }}</p>
</div>
