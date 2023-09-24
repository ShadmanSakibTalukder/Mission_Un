<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Mail\SendLoginCredentialMail;
use App\Models\User;
use App\Notifications\SendLoginCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::all();
        return view('admin.mission.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionRequest $request)
    {
        // dd($request);
        $requestData = [
            'name' => $request->name,
            'country' => $request->country,
            'address' => $request->address,
            'commanding_officer' => $request->commanding_officer,
            'co_email' => $request->co_email,
            'mto' => $request->mto,
            'mto_email' => $request->mto_email,
        ];

        $mission = Mission::create($requestData);
        $this->generateUserAccounts($mission);

        return redirect()->back()->with('success_message', 'Mission Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
    }

    // private function generateUserAccounts(Mission $mission)
    // {
    //     $coUser = User::create([
    //         'name' => $mission->commanding_officer,
    //         'email' => $mission->co_email,
    //         'password' => bcrypt(Str::random(8)),
    //         'mission_id' => $mission->id,
    //         'role_as' => 1,
    //     ]);
    //     $coUser->notify(new SendLoginCredentials());

    //     $mtoUser = User::create([
    //         'name' => $mission->mto,
    //         'email' => $mission->mto_email,
    //         'password' => bcrypt(Str::random(8)),
    //         'mission_id' => $mission->id,
    //         'role_as' => 1,
    //     ]);
    //     $mtoUser->notify(new SendLoginCredentials());
    // }


    private function generateUserAccounts(Mission $mission)
    {
        $coPassword = Str::random(8);
        $mtoPassword = Str::random(8);
        $role = 1;
        $coUser = User::create([
            'name' => $mission->commanding_officer,
            'email' => $mission->co_email,
            'password' => $coPassword,
            'mission_id' => $mission->id,
            'role_as' => $role,
        ]);

        // Generate a random password or use your password generation logic


        // Send the email with login credentials, including user ID and password
        Mail::to($coUser->email)->send(new SendLoginCredentialMail($coUser, $coPassword));

        $mtoUser = User::create([
            'name' => $mission->mto,
            'email' => $mission->mto_email,
            'password' => $mtoPassword,
            'mission_id' => $mission->id,
            'role_as' => '1',
        ]);

        // Generate a random password or use your password generation logic


        // Send the email with login credentials, including user ID and password
        Mail::to($mtoUser->email)->send(new SendLoginCredentialMail(
            $mtoUser,
            $mtoPassword
        ));
    }
}
