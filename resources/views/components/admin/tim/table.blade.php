<tr class=" border-b bg-gray-800 border-gray-700">
    <th scope="row" class="px-3 md:px-6 py-4 text-gray-400">
        {{ $num }}
    </th>
    <td class="px-3 md:px-6 py-4 font-medium  uppercase whitespace-nowrap text-white">
        {{ $tim }}
    </td>
    <td class="px-3 md:px-6 py-4 text-white">
        {{ $season }}
    </td>
    <td class="py-4 px-2 md:px-6 flex flex-row ">
        <button data-modal-target="tim-view{{ $id }}" data-modal-toggle="tim-view{{ $id }}"
            class="font-medium text-white bg-green-500 hover:underline px-2 py-1 rounded-3xl">
            View
        </button>
        <a href="link#update {{ $id }} "
            class="font-medium text-white bg-blue-500 hover:underline px-2 py-1 rounded-3xl">
            Edit
        </a>
        <form action="link#delete {{ $id }}" method="Post">
            {{-- @csrf --}}
            {{-- @method('DELETE') --}}
            <button type="submit"
                class="font-medium text-white px-2 py-1 rounded-3xl bg-red-600 hover:underline">Delete</button>
        </form>
    </td>
</tr>
