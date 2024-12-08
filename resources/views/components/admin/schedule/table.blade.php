<tr class=" border-b bg-gray-800 border-gray-700">
    <th scope="row" class="px-3 md:px-6 py-4 text-gray-400">
        {{ $num }}
    </th>
    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
        {{ $tima }}
    </td>
    <td class="px-3 md:px-6 py-4 text-white">
        {{ $scorea }}
    </td>
    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
        {{ $timb }}
    </td>
    <td class="px-3 md:px-6 py-4 text-white">
        {{ $scoreb }}
    </td>
    <td class="px-3 md:px-6 py-4 text-white">
        {{ $time }}
    </td>
    <td class="py-4 px-2 md:px-6 flex flex-row ">
        <button data-modal-target="schedule-view{{ $id }}" data-modal-toggle="schedule-view{{ $id }}"
            class="font-medium text-white bg-green-500 hover:underline px-2 py-1 rounded-3xl">
            <x-uiw-eye class="text-white w-4" />
        </button>
        <a href="link#update {{ $id }} "
            class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-3xl">
            <x-uiw-edit class="text-white w-4" />
        </a>
        <form action="link#delete {{ $id }}" method="Post">
            {{-- @csrf --}}
            {{-- @method('DELETE') --}}
            <button type="submit" class="font-medium text-white px-2 py-1 rounded-3xl bg-red-600 hover:underline">
                <x-uiw-delete class="text-white w-4" />
            </button>
        </form>
    </td>
</tr>
