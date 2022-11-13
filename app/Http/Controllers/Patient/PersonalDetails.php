<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class PersonalDetails extends Controller
{
    public function displayNameUpdate()
    {
            $name=Auth::user()->name;
            return view('patient_panel.personalInfo.updateDisplayName',['name'=>$name]);

    }
     public function displayNameUpdated(Request $request)
    {

        $id=Auth::user()->id;

        $user=User::where('id',$id);

        $user->update(['name'=>$request->name]);
        // dd($user);
        return redirect()->back()->withSuccess(__('Display Name is Successfully Updated'));
}
    public function phoneNumberUpdate()
    {


             return view('patient_panel.personalInfo.updatePhoneNumber');


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
}
