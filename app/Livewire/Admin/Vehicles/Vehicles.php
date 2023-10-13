<?php

namespace App\Livewire\Admin\Vehicles;

use App\Livewire\Admin;
use Livewire\Component;
use App\Models\VehicleItems;
use Livewire\WithPagination;
use App\Models\AddToVehicleList;
use App\Models\Vehicles as ModelsVehicles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Vehicles extends Component
{
    use WithPagination;
    public $part_no, $nomenclature, $qty, $vin_no, $captain;
    public $added_to_list = [];
    public function fetchData()
    {
        $response = Http::get('http://127.0.0.1:8000/api/mission_part_list');
        $parts = $response['data'];
        return $parts;
        // $data = $response->json();
        // return $data;
    }

    public function vehicleListStatic()
    {
        $userMissionId = Auth::user()->mission_id;
        $existingItem = AddToVehicleList::where('part_no', $this->part_no)->first();

        if ($existingItem) {
            session()->flash('message', $existingItem->nomenclature . ' already added to wishlist!');
        } else {
            $this->validate([
                'part_no' => 'string',
                'nomenclature' => 'string',
                'qty' => 'required',
            ]);

            $order_item = AddToVehicleList::create([
                'part_no' => $this->part_no,
                'nomenclature' => $this->nomenclature,
                'qty' => $this->qty,
                'mission_id' => $userMissionId,
            ]);

            session()->flash('success_message', $order_item->nomenclature . ' added to wishlist!');
            $this->reset(['qty']);

            $this->reset(['part_no', 'nomenclature', 'qty']);
        }
    }

    public function vehicleListDynamic($partId)
    {
        $userMissionId = Auth::user()->mission_id;
        $existingItem = AddToVehicleList::where('part_no', $this->part_no)->first();
        $parts = $this->fetchData();

        // $part = $parts->findOrFail($partId);
        // dd($part);

        if ($existingItem) {
            session()->flash('message', $existingItem->nomenclature . ' already added to wishlist!');
        } else {
            $part = null;
            foreach ($parts as $item) {
                if ($item['id'] == $partId) {
                    $part = $item;
                    break;
                }
            }

            if ($part) {
                // dd($part['requestedPartNo']);
                AddToVehicleList::create([
                    'part_no' => $part['requestedPartNo'],
                    'nomenclature' => $part['requestedNomenclature'],
                    'qty' => $this->qty,
                    'mission_id' => $userMissionId,

                ]);
                session()->flash('success_message', 'Product added to cart!');
                $this->reset(['qty']);
            } else {
                dd("Part with ID {$partId} not found.");
            }
        }
    }
    public function removeListItem($listId)
    {
        $itemInList = AddToVehicleList::where('id', $listId)->first();
        if ($itemInList) {
            $itemInList->delete();
            // $this->emit('ListUpdate');
            session()->flash('success_message', 'Deleted!');
        } else {
            session()->flash('message', 'Something went wrong. Please refresh.');
            return false;
        }
    }
    public function vehicleOrder()
    {
        // dd('I am here');
        $this->validate([
            'vin_no' => 'required|string',
            'captain' => 'required|string',
        ]);

        $added_to_list = AddToVehicleList::all();

        $userMissionId = Auth::user()->mission_id;
        $vehicles = ModelsVehicles::create([
            'vin_no' => $this->vin_no,
            'mission_id' => $userMissionId,
            'captain' => $this->captain,
        ]);

        foreach ($added_to_list as $item) {
            VehicleItems::create([
                'vehicle_id' => $vehicles->id,
                'part_no' => $item->part_no,
                'nomenclature' => $item->nomenclature,
                'qty' => $item->qty,
            ]);
        }


        AddToVehicleList::query()->forceDelete();
        $this->reset(['vin_no', 'captain']);
        session()->flash('success_message', 'Vehicle created successfully!');
        return true;
    }


    public function render()
    {
        $userMissionId = Auth::user()->mission_id;
        $parts = $this->fetchData();
        $this->added_to_list = AddToVehicleList::where('mission_id', $userMissionId)->get();
        return view('livewire.admin.vehicles.vehicles', ['parts' => $parts, 'added_to_list' => $this->added_to_list]);
    }
}
