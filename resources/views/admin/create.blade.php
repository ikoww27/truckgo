@vite('resources/css/app.css', 'resources/js/app.js', 'resources/js/maps.js')
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Truck</h2>

            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="truck_id" class="block text-gray-700 text-sm font-bold mb-2">Truck ID</label>
                    <input type="text" name="truck_id" id="truck_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="goods" class="block text-gray-700 text-sm font-bold mb-2">Goods</label>
                    <input type="text" name="goods" id="goods"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
                    <input type="text" name="destination" id="destination"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Lat</label>
                    <input type="text" name="lat" id="lat"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Long</label>
                    <input type="text" name="long" id="long"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Next
                        Destination</label>
                    <input type="text" name="next_destination" id="next_destination"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-black shadow-sm hover:bg-indigo-500 ">
                        <svg class="-ml-0.5 mr-1.5 size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Truck
                    </button>
                    <a href="{{ route('admin.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
