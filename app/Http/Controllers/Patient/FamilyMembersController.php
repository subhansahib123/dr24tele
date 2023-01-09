<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\FamilyMembers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class FamilyMembersController extends Controller
{
    public function index()
    {

        return view('patient_panel.familyMembers.create');
    }
    public function create(Request $request)
    {
        

        $userInfo = Auth::user()->patient->id;
        // dd(Auth::user()->patient->id);
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
            return redirect()->route('showMembers')->withSuccess(__('Family Member is Successfully Created'));
        }
    }
    public function show()
    {
        $userInfo = Auth::user()->patient->id;
        $all_members = FamilyMembers::where('patient_id', $userInfo)->get();
        return view('patient_panel.familyMembers.index', ['all_members' => $all_members]);
    }
    public function updateView($id)
    {
        $member = FamilyMembers::find($id);
        return view('patient_panel.familyMembers.update', ['member' => $member]);
    }
    public function update(Request $request)
    {
        

        $member = FamilyMembers::find($request->id);
        // dd($member);
        $member->update([
            'name' => $request->memberName,
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'relation' => $request->relation,
        ]);
        return redirect()->route('showMembers')->withSuccess(__('Member Details are Successfully Updated'));
    }
    public function delete($id)
    {
        $member = FamilyMembers::find($id);
        // dd($member);
        $member->delete();
        return redirect()->back()->withSuccess(__('Member is  Successfully Deleted'));
    }

}
