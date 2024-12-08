<div class="md:mb-3 mb-5">
    <label label="{{ $title }}" class="block mb-2 text-sm font-medium text-white capitalize"> Player
        {{ $title }}
    </label>
    <div class="flex flex-col md:flex-row gap-2">
        <input type="text" name="nickname{{ $title }}"
            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
            placeholder="Nickname player {{ $title }}" />
        <input type="number" name="id_nickname{{ $title }}"
            class=" border w-2xl  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-red-500 focus:border-red-500 shadow-sm-light"
            placeholder="id player {{ $title }}" />
    </div>
</div>
