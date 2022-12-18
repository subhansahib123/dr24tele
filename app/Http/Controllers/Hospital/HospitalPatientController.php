<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\UsersOrganization;
use App\Models\Organization;
use Illuminate\Support\Str;


class HospitalPatientController extends Controller
{
    public function storeHospitalPatients(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'image' => 'required|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=300,min_height=350',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $orgId = \auth()->user()->user_organization->organization;
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/organization/patients/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }
        try {
            $UserData = User::firstOrCreate([
                'username' => $request->username,
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonId' => Str::uuid(),
                'status' => 1,
                'PersonUuid' => Str::uuid(),
                'image' => $image
            ]);


            return $this->patientMapping($orgId->id, $UserData->id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function createHospitalPatients()
    {
        $users = User::all();
        return view('hospital_panel.patients.create', ['users' => $users]);
    }


    protected function patientMapping($orgId, $userId)
    {
        try {
            Patient::firstOrCreate([
                'user_id' => $userId,
                'organization_id' => $orgId,
                'status' => 1,
            ]);
            UsersOrganization::firstOrCreate([

                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $userId,
                'organization_id' => $orgId
            ]);

            return redirect()->route('hospitalAll.patients')->withSuccess(__('Patient Successfully Created'));
        } catch (\Exception $e) {
            return redirect()->route('createHospital.patients')->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function hospitalAllPatients()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $orgId = \auth()->user()->user_organization->organization;
        try {
            $all_patients = Patient::with('user')->where('organization_id', $orgId->id)->get();
            return view('hospital_panel.patients.index', ['all_patients' => $all_patients]);
        } catch (\Exception $e) {
            return redirect()->back()->withError(__($e->getMessage()));
        }
    }
    public function patientDelete($uuid)
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {


            $user = User::where('uuid', $uuid)->first();
            if ($user) {
                UsersOrganization::where('user_id', $user->id)->delete();
                Patient::where('user_id', $user->id)->delete();
                $user->delete();
            }
            return redirect()->back()->withSuccess(__('Successfully Patient Deleted'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
