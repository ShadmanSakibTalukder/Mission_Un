<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {

        $missions = Mission::where('status', 0)->get();


        if (Auth::user()->role_as == '1') {
            return view('admin.index');
        } elseif (Auth::user()->role_as == '2') {
            return view('admin.commandent', compact('missions'));
        } else {
            return redirect()->back()->with('message', 'Access not Authorised');
        }
    }
}
