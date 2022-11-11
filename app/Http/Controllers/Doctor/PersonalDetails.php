<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalDetails extends Controller
{
    public function displayNameUpdated()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('doctor.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return redirect()->back()->withErrors(['error' => 'This portion is in development phase. Try again later.']);
    }
    public function updateDisplayName()
    {
        // dd($userInfo);

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('doctor.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $name = $userInfo['name'];
        return view('doctor_panel.personalInfo.updateDisplayName', ['name' => $name]);
    }
    public function phoneNumberUpdated(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phoneNumber' => 'required|string',
            'newPhoneNumber' => 'required|string',
        ]);
        $user = User::where('phone_number', $request->phoneNumber)->first();
        if ($user) {
            $user->update([
                'phone_number' => $request->newPhoneNumber,
            ]);
            return redirect()->back()->withSuccess(__('Phone Number Successfully Updated'));
        } else {
            return redirect()->back()->withErrors(['error' => 'Current Phone Number is not correct']);
        }
    }
    public function updatePhoneNumber()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);

        if (is_null($userInfo)) {

            return redirect()->route('doctor.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $uuid = $userInfo['uuid'];
        $user = User::with('doctor')->where('uuid', $uuid)->first();

        $phoneNumber = $user->phone_number;
        return view('doctor_panel.personalInfo.updatePhoneNumber', ['name' => $phoneNumber]);
    }
}
