<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalDetails extends Controller
{
    public function displayNameUpdated(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $id=Auth::user()->id;

        $user=User::where('id',$id);

        $user->update(['name'=>$request->displayName]);
        return redirect()->back()->withSuccess(__('Display Name is Successfully Updated'));
    }
    public function updateDisplayName()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $displayName=Auth::user()->name;
        return view('doctor_panel.personalInfo.updateDisplayName',['displayName'=>$displayName]);
    }
    public function phoneNumberUpdated(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
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
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $phoneNumber = Auth::user()->phone_number;
        return view('doctor_panel.personalInfo.updatePhoneNumber', ['name' => $phoneNumber]);
    }
}
