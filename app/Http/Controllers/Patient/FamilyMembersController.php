<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\FamilyMembers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class FamilyMembersController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        $userInfo = session('loggedInUser');

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return view('patient_panel.familyMembers.create');
    }
    public function create(Request $request)
    {
        // dd($request->phoneNumber);
        $request->validate([
            'memberName' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|integer',
            'relation' => 'required|string',
        ]);
        $userInfo = session('loggedInUser');
        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $user = FamilyMembers::where('name', $request->memberName)->where('patient_id', $userInfo)->first();

        if ($user) {
            return redirect()->back()->withErrors(['error' => 'This Member is Already Created with relation ' . $user->relation . '.Try to Update  Member']);
        } else {
            FamilyMembers::firstOrCreate([
                'name' => $request->memberName,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'relation' => $request->relation,
                'patient_id' => $userInfo,
            ]);
            return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
        }
    }
    public function show()
    {
        $userInfo = session('loggedInUser');

        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $all_members = FamilyMembers::where('patient_id', $userInfo)->get();
        return view('patient_panel.familyMembers.index', ['all_members' => $all_members]);
    }
    public function updateView($id)
    {
        $userInfo = session('loggedInUser');

        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $member = FamilyMembers::find($id);
        return view('patient_panel.familyMembers.update', ['member' => $member]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'memberName' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|integer',
            'relation' => 'required|string',
        ]);
        $userInfo = session('loggedInUser');

        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $member = FamilyMembers::find($request->id);
        // dd($member);
        $member->update([
            'name' => $request->memberName,
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'relation' => $request->relation,
        ]);
        return redirect()->back()->withSuccess(__('Member Details are Successfully Updated'));
    }
    public function delete($id)
    {
        $userInfo = session('loggedInUser');

        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $member = FamilyMembers::find($id);
        // dd($member);
        $member->delete();
        return redirect()->back()->withSuccess(__('Member is  Successfully Deleted'));
    }
    
}
