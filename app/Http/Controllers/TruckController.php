<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\AdminTruck; 
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function getTruckLocations()
    {
        $trucks = AdminTruck::all();
   
        return response()->json($trucks);
    }

    public function searchTrucks(Request $request)
{
    $query = $request->input('query');
    
    // Cari berdasarkan kolom tertentu, misalnya `truck_id`, `goods`, atau `destination`
    $trucks = AdminTruck::where('truck_id', 'LIKE', "%$query%")
                ->orWhere('goods', 'LIKE', "%$query%")
                ->orWhere('destination', 'LIKE', "%$query%")
                ->orWhere('next_destination', 'LIKE', "%$query%")
                ->get();

    return response()->json($trucks);
}

}
