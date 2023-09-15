<?php

namespace App\Livewire\Admin\Requested;

use no;
use Livewire\Component;
use App\Models\AddToList;
use App\Models\Quotation;
use Livewire\WithPagination;
use App\Models\QuotationItems;
use Illuminate\Support\Facades\Http;

class Create extends Component
{

    use WithPagination;
    
    public $part_no, $nomenclature, $qty, $requested_order_no, $requested_by, $requested_date;
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

    public function addToListDynamic($partId)
    {
        $parts = $this->fetchData();
        // $part = $parts->findOrFail($partId);
        // dd($part);

        $part = null;
        foreach ($parts as $item) {
            if ($item['id'] == $partId) {
                $part = $item;
                break;
            }
        }

        if ($part) {
            // dd($part['requestedPartNo']);
            AddToList::create([
                'part_no' => $part['requestedPartNo'],
                'nomenclature' => $part['requestedNomenclature'],
                'qty' => $this->qty,
               
            ]);
            session()->flash('success_message', 'Product added to cart!');
        } else {
            dd("Part with ID {$partId} not found.");
        }
    }
 
    
    public function quotationOrder()
{
    $this->validate([
        'requested_order_no' => 'required|string',
        'requested_by' => 'required|string',
        'requested_date' => 'required|date',
    ]);

    $added_to_list = AddToList::all();

    $quotation = Quotation::create([
        'requested_order_no' => $this->requested_order_no,
        'requested_by' => $this->requested_by,
        'requested_date' => $this->requested_date,
    ]);

    foreach ($added_to_list as $item) {
        QuotationItems::create([
            'quote_no' => $quotation->id,
            'part_no' => $item->part_no,
            'nomenclature' => $item->nomenclature,
            'qty' => $item->qty,
        ]);
    }

    AddToList::query()->forceDelete();
    $this->reset(['requested_order_no', 'requested_by', 'requested_date']);
    return true;
}

    public function render()
    {
        $parts = $this->fetchData();
        $this->added_to_list = AddToList::all();
        
        return view('livewire.admin.requested.create', ['parts'=>$parts,'added_to_list'=> $this->added_to_list]);
    
    }




}
