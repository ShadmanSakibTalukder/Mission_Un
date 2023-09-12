<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestedController extends Controller
{
    public function index()
    {
        return view ('admin.requested.index');
    }

    public function create()
    {
        return view('admin.requested.create');
    }
}
