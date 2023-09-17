<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationApiController extends Controller
{
    public function index()
    {
        $quotation = Quotation::all();
        return response()->json($quotation);
    }
}
