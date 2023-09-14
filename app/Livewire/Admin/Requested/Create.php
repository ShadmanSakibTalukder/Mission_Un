<?php

namespace App\Livewire\Admin\Requested;

use Livewire\Component;
use App\Models\AddToList;
use Illuminate\Support\Facades\Http;

class Create extends Component
{

    public $part_no, $nomenclature, $qty;
    public $added_to_list = [];
    public function fetchData()
    {
        $response = Http::get('http://127.0.0.1:8000/api/mens_part_list');
        $parts = $response['data'];
        return $parts;
        // $data = $response->json();
        // return $data;
    }
     
    public function addToListStatic(){
        $existingItem = AddToList::where('part_no', $this->part_no)->first();

        if ($existingItem) {
            session()->flash('message', $existingItem->nomenclature . ' already added to wishlist!');
        } else {
            $this->validate([
                'part_no' => 'string',
                'nomenclature' => 'string',
                'qty' => 'required',
            ]);

            $order_item = AddToList::create([
                'part_no' => $this->part_no,
                'nomenclature' => $this->nomenclature,
                'qty' => $this->qty,
            ]);

            // $this->emit('addToTenderListUpdated');
            session()->flash('success_message', $order_item->nomenclature . ' added to wishlist!');

            $this->reset(['part_no', 'nomenclature', 'qty']);
        }
    }

    public function render()
    {
        $parts = $this->fetchData();
        $this->added_to_list = AddToList::all();
        return view('livewire.admin.requested.create', ['parts'=>$parts,'added_to_list'=> $this->added_to_list]);
    }




}
