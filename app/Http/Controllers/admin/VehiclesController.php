<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddToList;
use App\Models\AddToVehicleList;
use App\Models\VehicleItems;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VehiclesController extends Controller
{
    public function fetchData()
    {
        $response = Http::get('http://127.0.0.1:8000/api/mens_part_list');
        $parts = $response['data'];
        return $parts;
        // $data = $response->json();
        // return $data;
    }
    public function index()
    {
        $mission = Auth::user()->mission_id;
        $parts = $this->fetchData();
        $vehicles = Vehicles::where('mission_id', $mission)->get();
        return view('admin.vehicles.index', compact('vehicles', 'parts'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    // public function partsUsed($id)
    // {
    //     $vehicleItem = VehicleItems::findOrFail($id)->first();
    //     $userMissionId = Auth::user()->mission_id;
    //     $existingItem = AddToVehicleList::findOrFail($id)->first();
    //     // dd($vehicleItem);
    //     if ($existingItem) {
    //         $existingItem->increment('qty');
    //     } else {
    //         AddToVehicleList::create(
    //             [
    //                 'part_no' => $vehicleItem->part_no,
    //                 'nomenclature' => $vehicleItem->nomenclature,
    //                 'mission_id' => $userMissionId,
    //             ]
    //         );
    //     }
    //     $vehicleItem->decrement('qty');
    //     return response()->json(['message' => 'Item used successfully']);
    // }

    public function partsUsed($id)
    {
        $vehicleItem = VehicleItems::findOrFail($id);
        // dd($vehicleItem);
        $userMissionId = Auth::user()->mission_id;
        $existingItem = AddToList::where('part_no', $vehicleItem->part_no)
            ->where('mission_id', $userMissionId)
            ->first();

        if ($existingItem) {
            $existingItem->increment('qty');
        } else {
            AddToList::create([
                'part_no' => $vehicleItem->part_no,
                'nomenclature' => $vehicleItem->nomenclature,
                'mission_id' => $userMissionId,
            ]);
        }

        $newQty = $vehicleItem->decrement('qty');

        // return response()->json(['message' => 'Item used successfully'], 200);
        return response()->json(['success' => true, 'qty' => $newQty]);
    }
}
