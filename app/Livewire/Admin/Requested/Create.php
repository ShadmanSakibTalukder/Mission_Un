<?php

namespace App\Livewire\Admin\Requested;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Create extends Component
{
    public function fetchData()
    {
        $response = Http::get('http://127.0.0.1:8000/api/mens_part_list');
        $parts = $response['data'];
        return $parts;
    }
    public function render()
    {
        $parts = $this->fetchData();
        return view('livewire.admin.requested.create', compact('parts'));
    }
}
