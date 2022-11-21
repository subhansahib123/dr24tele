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
        $user = User::with('doctor')->where('phone_number', auth()->user()->phone_number)->first();
        // dd($user);

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $request->validate([
            'phoneNumberNew' => 'required|string',
        ]);
        $user->update(['phone_number'=>$request->phoneNumberNew]);
        // dd($user->phone_number);
        return redirect()->route('doctor.dashboard')->withSuccess(__('Phone Number is Successfully Updated'));
        
    }

    public function phoneNumberVerified(Request $request)
    {
        // dd($request->all());
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $request->validate([
            'phoneNumber' => 'required|string',
            'role' => 'required|string',
        ]);
        $user = User::with('doctor')->where('phone_number', $request->phoneNumber)->first();
        if ($user) {
            return view('doctor_panel.personalInfo.updatingNumber');
        } else {
            return redirect()->back()->withErrors(['error' => 'Current Phone Number is not correct']);
        }
    }
    public function verifyPhoneNumber()
    {
        
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        return view('doctor_panel.personalInfo.phoneNumberVerifcation');
    }
}
