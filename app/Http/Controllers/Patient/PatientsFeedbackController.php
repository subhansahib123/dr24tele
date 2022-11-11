<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientsFeedback;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class PatientsFeedbackController extends Controller
{
    public function index()
    {
        return view('public_panel.template_pages.rateDoctor');
    }
    public function store(Request $request)
    {
        // dd($request->all());?
        $request->validate([
            'rating'=>'required|numeric',
            'feedback'=>'required|string',
        ]);
        PatientsFeedback::firstOrCreate([
            'patient_id'=>'1',
            'doctor_id'=>'1',
            'rating'=>$request->rating,
            'feedback'=>$request->feedback,
        ]);
        return redirect()->back()->withSuccess(__('Feedback is Successfully Saved'));
    }
}
