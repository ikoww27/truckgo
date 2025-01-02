@vite('resources/css/app.css', 'resources/js/app.js', 'resources/js/maps.js')
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto  rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Truck</h2>
 
            <form action="{{ route('admin.update', $truck->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="truck_id" class="block text-gray-700 text-sm font-bold mb-2">Truck ID</label>
                    <input type="text" name="truck_id" id="truck_id" value="{{ $truck->truck_id }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
 
                <div class="mb-4">
                    <label for="goods" class="block text-gray-700 text-sm font-bold mb-2">Goods</label>
                    <input type="text" name="goods" id="goods" value="{{ $truck->goods }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
 
                <div class="mb-4">
                    <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
                    <input type="text" name="destination" id="destination" value="{{ $truck->destination }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
 
                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Lat</label>
                    <input type="number" name="lat" id="lat" value="{{ $truck->lat }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Long</label>
                    <input type="number" name="long" id="long" value="{{ $truck->long }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="next_destination" class="block text-gray-700 text-sm font-bold mb-2">Next Destination</label>
                    <input type="text" name="next_destination" id="next_destination" value="{{ $truck->next_destination }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
 
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black font-bold py-2 px-4 rounded">
                        Update
                    </button>
                    <a href="{{ route('admin.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
 </div>
 