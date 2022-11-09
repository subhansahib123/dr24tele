<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalDetails extends Controller
{
    public function displayNameUpdate()
    {
        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo),true);
        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        // dd($userInfo);
        $name=$userInfo['name'];
        return view('patient_panel.personalInfo.updateDisplayName',['name'=>$name]);
    }
    public function phoneNumberUpdate()
    {
        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo),true);
        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $name=$userInfo['name'];
        return view('patient_panel.personalInfo.updatePhoneNumber',['name'=>$name]);
    }
}
