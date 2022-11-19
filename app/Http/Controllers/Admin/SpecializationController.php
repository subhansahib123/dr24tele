<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecializationController extends Controller
{
    public function index()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        return view('admin_panel.specialization.create');
    }
    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        DoctorSpecialization::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
    public function show()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        $specializations = DoctorSpecialization::all();
        return view('admin_panel.specialization.index', ['specializations' => $specializations]);
    }
    public function updateView($id)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        $specialization=DoctorSpecialization::find($id);
        return view('admin_panel.specialization.update',['specialization'=>$specialization]);
    }
    public function update(Request $request)
    {
        $request->validate(['newName'=>'required|string']);
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        
        $specialization=DoctorSpecialization::find($request->id);
        // dd($request->all());
        $specialization->update(['name' => $request->newName]);
        return redirect()->back()->withSuccess(__('Specialization is Successfully Created'));
    }
}
