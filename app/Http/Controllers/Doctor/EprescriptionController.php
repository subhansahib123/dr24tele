<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Mail\Prescription;
use App\Models\Doctor;
use App\Models\Eprescription;
use App\Models\EprescriptionDetail;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EprescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $doctor = User::with('doctor')->find($user->id);
        return view('doctor_panel.eprescription.create', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization_id' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'appointment_id' => 'required',
        ]);

        $eprescription = Eprescription::create([
            'organization_id' => $request->organization_id,
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id
        ]);

        if ($eprescription) {
            foreach ($request->eprescription as $prescription) {
                $eprescription->eprescriptiondetail->create([
                    'medicine' => $prescription['medicine'],
                    'morning' => $prescription['morning'],
                    'after_noon' => $prescription['after_noon'],
                    'evening' => $prescription['evening'],
                    'comment' => $prescription['comment']
                ]);
            }
        }
        $body = Eprescription::with('eprescriptiondetail')->find($eprescription->id);
        $patient = Patient::with('user')->find($request->patient_id);
        Mail::to($patient->user->email)->send(new Prescription($body));
        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Eprescription $eprescription
     * @return \Illuminate\Http\Response
     */
    public function show(Eprescription $eprescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Eprescription $eprescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Eprescription $eprescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Eprescription $eprescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eprescription $eprescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Eprescription $eprescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eprescription $eprescription)
    {
        //
    }
}
