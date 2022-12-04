<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentSpecializations;
use App\Models\Organization;
use App\Models\SpecializedDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        $specializations = DepartmentSpecializations::all();
        // dd($specializations);
        return view('admin_panel.departments.create', ['organizations' => $organizations, 'specializations' => $specializations]);
    }
    public function create(Request $request)
    {
        // dd($request->email()); 

        $orgName = Organization::where('uuid', $request->organization)->first();
        // dd( $orgName );
        $request->validate([
            'name'  => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
            'organization' => 'required|string',
            'image' => 'required',
            'specialization_id.*' => 'required|string',
        ]);
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/department/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $parent_org_uuid = $request->has('input_org') ? $request->input_org : $request->organization;
        // dd($parent_org_uuid);

        try {
            if ($request->name) {
                // dd($request->level,$request->all());
                $org = Organization::where('uuid',  $parent_org_uuid)->first();
                $dep= Department::firstOrCreate([
                    'name' => $request->name . '_' . $orgName->name,
                    'organization_id' => $org->id,
                    'email'=>$request->email,
                    'display_name' => $request->displayname,
                    'status'=>$request->status,
                    'image' => $image,
                    'level' => "SubOrg",
                    'uuid' => Str::uuid(),
                ]);
                $department = Department::where('name', $request->name . '_' . $org->name)->first();
                // dd($dep);
                $specializations = $request->specialization_id;
                // dd($specializations,$department);
                foreach ($specializations as $specialization) {
                    // dd($specialization);
                    SpecializedDepartment::Create([
                        'specialization_id' => $specialization,
                        'department_id' => $department->id,
                    ]);
                }
                return redirect()->back()->withSuccess(__('Successfully Department Created'));
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function deleteDepartment($uuid)
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $dep = Department::where('uuid', $uuid)->first();
            if ($dep) {
                // dd($dep);
                $dep->delete();
                return redirect()->back()->withSuccess(__('Department Successfully Deleted'));
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function departmentsList($uuid)
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {
            $org = Organization::where('uuid', $uuid)->first();
            $departments = Department::where('organization_id', $org->id)->get();
            // dd($departments);
            return view('admin_panel.departments.show', ['departments' => $departments]);
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateDepartment(Request $request)
    {


        // dd($request->all());
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'image' => 'required',

        ]);
        

        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/department/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }

        try {
            $dep = Department::where('uuid', $request->DepUuid)->first();
            $dep->update([
                'display_name' => $request->displayname,
                'email'=>$request->email,
                'status'=>$request->status,
                'image'=> $image

            ]);
            return redirect()->back()->withSuccess(__('Department  Successfully Updated'));

        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
