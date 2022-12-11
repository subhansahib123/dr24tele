<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorSpecialization;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DoctorSpecializationController extends Controller
{
    public function index()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return view('hospital_panel.specialization.create');
        }
        return view('admin_panel.specialization.create');
    }
    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $specialization = DoctorSpecialization::where('name', $request->name)->first();
        if ($specialization) {
            return redirect()->back()->withErrors(['error' => 'This Specialization already exists.']);
        }
        DoctorSpecialization::firstOrCreate(['name' => $request->name]);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return redirect()->route('show.specialization')->withSuccess(__('Specialization is Successfully Created'));
        }
        return redirect()->route('showSpecialization')->withSuccess(__('Specialization is Successfully Created'));
    }
    public function show()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $specializations = DoctorSpecialization::all();
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return view('hospital_panel.specialization.index', ['specializations' => $specializations]);
        }
        return view('admin_panel.specialization.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $specialization = DoctorSpecialization::find($id);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return view('hospital_panel.specialization.update', ['specialization' => $specialization]);
        }
        return view('admin_panel.specialization.update', ['specialization' => $specialization]);
    }
    public function update(Request $request)
    {
        $request->validate(['newName' => 'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $specialization = DoctorSpecialization::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return redirect()->route('show.specialization')->withSuccess(__('Specialization is Successfully Updated'));
        }
        return redirect()->route('showSpecialization')->withSuccess(__('Specialization is Successfully Updated'));
    }
    public function delete($id)
    {
        $doctor_specialization = DoctorSpecialization::find($id);
        $doctor_specialization->delete();
        // dd($id);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Deleted'));
    }
}
