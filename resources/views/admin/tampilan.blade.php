@vite('resources/css/app.css', 'resources/js/app.js', 'resources/js/maps.js')
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Truck Management</h1>
        <a href="{{ route('admin.create') }}"
            class="bg-blue-500 hover:bg-blue-600 font-bold border border-spacing-4 text-black px-4 py-2 rounded-lg">
            Add New Truck
        </a>
    </div>

    <div class="bg-white rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300 border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Truck ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Goods</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Destination</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Lat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Long</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Next Destination</th>
                    <th
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border border-gray-300">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="text-center  divide-y divide-slate-700 ">
                @foreach ($trucks as $truck)
                    <tr>
                        <td class="px-6 py-4 border border-sky-900">{{ $truck->truck_id }}</td>
                        <td class="px-6 py-4 border border-gray-300">{{ $truck->goods }}</td>
                        <td class="px-6 py-4 border border-gray-300">{{ $truck->destination }}</td>
                        <td class="px-6 py-4 border border-gray-300">{{ $truck->lat }}</td>
                        <td class="px-6 py-4 border border-gray-300">{{ $truck->long }}</td>
                        <td class="px-6 py-4 border border-gray-300">{{ $truck->next_destination }}</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <div class="flex">
                                <a href="{{ route('admin.edit', $truck->id) }}"
                                    class="mr-2 text-black bg-indigo-600 hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 inline-flex items-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.destroy', $truck->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-black bg-red-600 hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 border inline-flex items-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
