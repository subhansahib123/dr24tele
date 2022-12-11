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
        $id = Auth::user()->id;

        $user = User::where('id', $id);

        $user->update(['name' => $request->displayName]);
        return redirect()->back()->withSuccess(__('Display Name is Successfully Updated'));
    }
    public function updateDisplayName()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $displayName = Auth::user()->name;
        return view('doctor_panel.personalInfo.updateDisplayName', ['displayName' => $displayName]);
    }
    public function phoneNumberUpdated(Request $request)
    {
        $user = User::with('doctor')->where('phone_number', auth()->user()->phone_number)->first();
        // dd($user,$request->all());

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $request->validate([
            'phoneNumberNew' => 'required|string',
        ]);
        // dd($user->phone_number);

        $user->update(['phone_number' => $request->phoneNumberNew]);
        // dd($user );
        return redirect()->route('verifyPhoneNumber')->withSuccess(__('Phone Number is Successfully Updated'));
    }

    public function phoneNumberVerified(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $request->validate([
            'role' => 'required|string',
        ]);

        return view('doctor_panel.personalInfo.updatingNumber');
    }
    public function verifyPhoneNumber()
    {

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        return view('doctor_panel.personalInfo.phoneNumberVerifcation');
    }
}
