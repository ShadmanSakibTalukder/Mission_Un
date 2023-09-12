<?php

namespace App\Http\Controllers\Admin;

use App\Models\Requested;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestedFormRequest;

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

    public function store(RequestedFormRequest $request)
    {
        $validatedData= $request->validated();
    $requested = new Requested;
    $requested->requested_id= $validatedData['requested_id'];
    $requested->part_no= $validatedData['part_no'];
    $requested->nomenclature= $validatedData['nomenclature'];
    $requested->qty= $validatedData['qty'];
    $requested->status= $request->status==true ? '1':'0';
    $requested->Save();

    return redirect('admin/requested')->with('message','Requested Order Added Successfully');
    }
}
