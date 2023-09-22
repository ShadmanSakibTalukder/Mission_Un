<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Illuminate\Http\Request;
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
        $parts = $this->fetchData();
        $vehicles = Vehicles::all();
        return view('admin.vehicles.index', compact('vehicles', 'parts'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }
}
