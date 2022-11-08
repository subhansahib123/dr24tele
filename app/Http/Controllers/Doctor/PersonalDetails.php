<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalDetails extends Controller
{
    public function updateDisplayName()
    {
        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo),true);
        $name=$userInfo['name'];
        return view('doctor_panel.personalInfo.updateDisplayName',['name'=>$name]);
    }
}
