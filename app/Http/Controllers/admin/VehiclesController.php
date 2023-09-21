<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function index()
    {
        return view('admin.vehicles.index');
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }
}
