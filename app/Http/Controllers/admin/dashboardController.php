<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Quotation;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $missionId = Auth::user()->mission_id;
        $missions = Mission::where('status', 0)->get();
        $vehicles = Vehicles::all();
        $quotation = Quotation::all();
        if ($missionId) {

            $missionVehicles = $vehicles->where('mission_id', $missionId);
            $missionQuotation = $quotation->where('mission_id', $missionId);
            $countMissionQuotation = $quotation->count();
            $countMissionCompletedQuotation = $quotation->where('status', '1')->count();
            $countMissionProcessingQuotation = $quotation->where('status', '0')->count();
        }
        $countQuotation = $quotation->count();
        $countCompletedQuotation = $quotation->where('status', '1')->count();
        $countprocessingQuotation = $quotation->where('status', '0')->count();





        if (Auth::user()->role_as == '1') {

            return view('admin.index', compact(
                'countMissionQuotation',
                'countMissionCompletedQuotation',
                'countMissionProcessingQuotation',
                'missionVehicles',
                'missionQuotation'
            ));
        } elseif (Auth::user()->role_as == '2') {
            return view('admin.commandent', compact('missions', 'countQuotation', 'vehicles'));
        } else {
            return redirect()->back()->with('message', 'Access not Authorised');
        }
    }
}
