<?php

namespace App\Http\Controllers\Admin;

use App\Models\Requested;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestedFormRequest;
use App\Models\Quotation;

class RequestedController extends Controller
{
    public function index()

    {
        $quotation = Quotation::all();

        return view('admin.requested.index', compact('quotation'));
    }

    public function create()
    {
        return view('admin.requested.create');
    }

    public function show($id)
    {
        $quotation = Quotation::findOrFail($id)->first();

        // dd($quotation->quotationItems);
        return view('admin.requested.show', compact('quotation'));
    }

    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id)->first();
        // dd($quotation);

        // dd($quotation);
        $quotation->delete();
        return redirect()->back()->with('message', 'Successfully deleted!');
    }
}
