<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
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
        // dd($request->all(),$user);   
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $request->validate([
            'newPhoneNumber' => 'required|string',
        ]);
        $user->update(['phone_number' => $request->newPhoneNumber]);
        return redirect()->route('logout')->withSuccess(__('Phone Number is Successfully Updated'));
    }

    public function phoneNumberVerified(Request $request)
    {

        return view('patient_panel.personalInfo.updatingNumber');
    }
    public function appointmentDetails($id)
    {
        $appointment=Appointment::where('id',$id)->first();
        $schedule=Schedule::where('id',$appointment->slot_id)->first();
        return view('patient_panel.appointment.details',compact('appointment','schedule'));
    }
}
