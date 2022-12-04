<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\Country;
use App\Models\Department;
use App\Models\DepartmentSpecializations;
use App\Models\SpecializedDepartment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class HospitalDepartmentController extends Controller
{
    public function createHospitalDepartment()
    {
        $organizations = Organization::all();
        $specializations = DepartmentSpecializations::all();
        return view(
            'hospital_panel.departments.create',
            [
                'organizations' => $organizations,
                'specializations' => $specializations,

            ]
        );
    }

    public function hospitalDepartmentCreated(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'level' => 'string',
            'image' => 'required',
            'specialization_id.*' => 'required|string',
        ]);

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $orgId = \auth()->user()->user_organization->organization->uuid;
        $org = Organization::where('uuid', $orgId)->first();
        try {
            if ($request->hasFile('image')) {
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = '';
            }
            Department::Create([
                'name' => $request->name . '_' . $org->name,
                'email' => $request->email,
                'slug' => $request->displayname,
                'image' => $image,
                'organization_id' => $org->id,
                'display_name' => $request->displayname,
                'level' => "SubOrg",
                'uuid' => Str::uuid(),
                'status' => $request->status
            ]);
            $department = Department::where('name', $request->name . '_' . $org->name)->first();
            $specializations = $request->specialization_id;
            foreach ($specializations as $specialization) {
                SpecializedDepartment::Create([
                    'specialization_id' => $specialization,
                    'department_id' => $department->id,
                ]);
            }
            return redirect()->back()->withSuccess(__('Successfully Department Created'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function hospitalDepartmentsList()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $org = \auth()->user()->user_organization->organization;
        try {
            $departments = Department::where('organization_id', $org->id)->get();
            return view('hospital_panel.departments.show', ['departments' => $departments]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateHospitalDepartment($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $depData = Department::where('uuid', $uuid)->first();
        $organization = Organization::where('id', $depData->organization_id)->first();
        try {
            return view('hospital_panel.departments.departmentForUpdate', ['organization' => $organization, 'depData' => $depData]);

        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function hospitalDepartmentUpdated(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,gif,svg,jpeg',
            'displayname' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $organization = Organization::where('uuid', $request->parentOrgId)->first();
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {

            $dep = Department::where('uuid', $request->DepUuid)->first();
            if ($request->hasFile('image')) {
                if (isset($dep) && $dep->image) {
                    $previous_img = public_path('uploads/organization/department/' . $dep->image);
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                }
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = $dep->image;
            }

            $dep->update([
                'name' => $request->displayname . '_' . $organization->name,
                'status' => $request->status,
                'display_name' => $request->displayname,
                'image' => $image,
                'email' => $request->email,
            ]);
            return redirect()->back()->withSuccess(__('Department Successfully Updated'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
