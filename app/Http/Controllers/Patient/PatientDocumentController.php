<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatienDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PatientDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = PatienDocument::where('patient_id', Auth::user()->patient->id)->get();
        return view('patient_panel.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient_panel.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $request->validate([
            'title' => 'required|string',
            'doc_file' => 'required',
        ]);

        try {
            if ($request->hasFile('doc_file')) {
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->doc_file->getClientOriginalExtension();
                $request->doc_file->move(public_path('uploads/organization/patients/records/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = '';
            }

            PatienDocument::create([
                'title' => $request->title,
                'doc_file' => $image,
                'patient_id' => Auth::user()->patient->id
            ]);
            return redirect()->route('document.index')->with('success', 'File Upload Success');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = PatienDocument::where('id',$id)->first();
        if(isset($doc)){
            $file = public_path('uploads/patient/document/'. $doc->doc_file);
            if(File::exists($file)){
                File::delete($file);
            }
        }
        $doc->delete();
        return redirect()->back()->with('success','Record Deleted');
    }
}
