<?php

namespace App\Http\Controllers;

use App\Models\DepartmentSpecializations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class DepartmentSpecializationController extends Controller
{
    public function index()
    {
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        if ($containsHospital == true) {
            return view('hospital_panel.specializationForDepartment.create');
        }
        return view('admin_panel.specializationForDepartment.create');
    }
    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        DepartmentSpecializations::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->withSuccess(__('Department Specialization is Successfully Created'));
    }
    public function show()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');

        $specializations = DepartmentSpecializations::all();
        if ($containsHospital == true) {
            return view('hospital_panel.specializationForDepartment.index', ['specializations' => $specializations]);
        }
        return view('admin_panel.specializationForDepartment.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $specialization = DepartmentSpecializations::find($id);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital == true) {
            return view('hospital_panel.specializationForDepartment.update', ['specialization' => $specialization]);
        }
        return view('admin_panel.specializationForDepartment.update', ['specialization' => $specialization]);
    }
    public function update(Request $request)
    {
        $request->validate(['newName' => 'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $specialization = DepartmentSpecializations::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
}
