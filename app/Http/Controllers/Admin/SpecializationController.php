<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return view('admin_panel.specialization.create');
    }
    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        DoctorSpecialization::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
    public function show()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specializations = DoctorSpecialization::all();
        return view('admin_panel.specialization.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specialization=DoctorSpecialization::find($id);
        return view('admin_panel.specialization.update',['specialization'=>$specialization]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);

        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $specialization=DoctorSpecialization::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
}
