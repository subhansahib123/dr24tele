<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalDetails extends Controller
{
    public function displayNameUpdated(Request $request)
    {
        $id=Auth::user()->id;

        $user=User::where('id',$id);

        $user->update(['name'=>$request->name]);
        return redirect()->back()->withSuccess(__('Display Name is Successfully Updated'));
    }
    public function updateDisplayName()
    {

        $name = Auth::user()->name;
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


        $phoneNumber = Auth::user()->phone_number;
        return view('doctor_panel.personalInfo.updatePhoneNumber', ['name' => $phoneNumber]);
    }
}
