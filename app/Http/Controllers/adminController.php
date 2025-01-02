<?php
namespace App\Http\Controllers;

use App\Models\AdminTruck;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $trucks = AdminTruck::all();
        return view('admin.tampilan', compact('trucks'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'truck_id' => 'required',
            'goods' => 'required',
            'destination' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'next_destination' => 'required',
        ]);

        AdminTruck::create($validated);
        return redirect()->route('admin.index')->with('success', 'Truck data added successfully');
    }
    public function destroy($id)
    {
        $truck = AdminTruck::findOrFail($id);
        $truck->delete();
        return redirect()->route('admin.index')->with('success', 'Truck deleted successfully');
    }
    //Membuat sistem edit
    public function edit($id)
    {
       $truck = AdminTruck::findOrFail($id);
       return view('admin.edit', compact('truck'));
    }
    
    public function update(Request $request, $id)
    {
       $validated = $request->validate([
           'truck_id' => 'required',
           'goods' => 'required', 
           'destination' => 'required',
           'lat' => 'required',
           'long' => 'required',
           'next_destination' => 'required'
       ]);
    
       $truck = AdminTruck::findOrFail($id);
       $truck->update($validated);
       
       return redirect()->route('admin.index')->with('success', 'Data updated successfully');
    }
}
