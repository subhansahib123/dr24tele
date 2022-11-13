<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\User;
use Illuminate\Http\Request;

class Specialization extends Controller
{
    public function index()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specializations = DoctorSpecialization::all();
        $uuid = $userInfo['uuid'];
        $user = User::with('doctor')->where('uuid', $uuid)->first();
        $doctor = Doctor::where('user_id', $user->id)->first();
        // dd($doctor->specialization_id);
        return view('doctor_panel.personalInfo.specialization', ['specializations' => $specializations, 'doctor' => $doctor]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(['specialization' => 'required']);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        //  dd($userInfo);
        $uuid = $userInfo['uuid'];
        $user = User::with('doctor')->where('uuid', $uuid)->first();
        $doctor = Doctor::where('user_id', $user->id)->first();

        $doctor->update([
            'specialization_id' => $request->specialization
        ]);
        return redirect()->back()->withSuccess(__('Your Specialization is Successfully Saved'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate(['specialization' => 'required']);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        //  dd($userInfo);
        $uuid = $userInfo['uuid'];
        $user = User::with('doctor')->where('uuid', $uuid)->first();
        $doctor = Doctor::where('user_id', $user->id)->first();
        if ($doctor->specialization_id != $request->specialization) {
            $doctor->update([
                'specialization_id' => $request->specialization
            ]);
            return redirect()->back()->withSuccess(__('Specialization Successfully Updated'));
        } else {
            return redirect()->back()->withErrors(['error' => 'You already Specialized in this field.']);
        }
    }
}
