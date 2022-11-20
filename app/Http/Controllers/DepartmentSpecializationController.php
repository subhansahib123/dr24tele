<?php

namespace App\Http\Controllers;

use App\Models\DepartmentSpecializations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentSpecializationController extends Controller
{
    public function index()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
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
        
        $specializations = DepartmentSpecializations::all();
        return view('admin_panel.specializationForDepartment.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        $specialization=DepartmentSpecializations::find($id);
        return view('admin_panel.specializationForDepartment.update',['specialization'=>$specialization]);
    }
    public function update(Request $request)
    {
        $request->validate(['newName'=>'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        $specialization=DepartmentSpecializations::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
}
