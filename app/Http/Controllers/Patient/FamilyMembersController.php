<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\FamilyMembers;
use Illuminate\Http\Request;

class FamilyMembersController extends Controller
{
    public function index()
    {
        
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        dd(session('loggedInUser'));
        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return view('patient_panel.familyMembers.create');
    }
    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        FamilyMembers::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
    public function show()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specializations = FamilyMembers::all();
        return view('patient_panel.specialization.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specialization=FamilyMembers::find($id);
        return view('patient_panel.specialization.update',['specialization'=>$specialization]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specialization=FamilyMembers::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
}
