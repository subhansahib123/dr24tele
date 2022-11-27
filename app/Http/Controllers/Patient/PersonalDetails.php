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
        $name = Auth::user()->name;
        return view('patient_panel.personalInfo.updateDisplayName', ['name' => $name]);
    }
    public function displayNameUpdated(Request $request)
    {

        $id = Auth::user()->id;

        $user = User::where('id', $id);

        $user->update(['name' => $request->name]);
        // dd($user);
        return redirect()->back()->withSuccess(__('Display Name is Successfully Updated'));
    }
    public function verifyPhoneNumber()
    {
        return view('patient_panel.personalInfo.verifyPhoneNumber');
    }
    public function phoneNumberUpdated(Request $request)
    {
        $user = User::with('doctor')->where('phone_number', auth()->user()->phone_number)->first();
        // dd($user);

        $request->validate([
            'phoneNumberNew' => 'required|string',
        ]);
        $user->update(['phone_number' => $request->phoneNumberNew]);
        // dd($user->phone_number);
        return redirect()->route('verifyPhoneNumber')->withSuccess(__('Phone Number is Successfully Updated'));
    }

    public function phoneNumberVerified(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phoneNumber' => 'required|string',
            'role' => 'required|string',
        ]);
        $user = User::with('patient')->where('phone_number', $request->phoneNumber)->first();
        if ($user) {
            return view('patient_panel.personalInfo.updatingNumber');
        } else {
            return redirect()->back()->withErrors(['error' => 'Current Phone Number is not correct']);
        }
    }
}
