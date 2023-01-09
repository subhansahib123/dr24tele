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
            'displayname' => 'required',
            'status' => 'required',
            'specialization_id.*' => 'required',
            'image' => 'required|image|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=1140,min_height=650'
        ]);

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $orgId = auth()->user()->user_organization->organization->uuid;
        $org = Organization::where('uuid', $orgId)->first();
        // dd($org);

        try {
            if ($request->hasFile('image')) {
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = '';
            }
            // dd(strtolower(str_replace(' ','',$request->displayname)) . '_' . $org->name);
            $department =Department::Create([
                'name' =>strtolower(str_replace(' ','',$request->displayname)). '_' .$org->name,
                'image' => $image,
                'organization_id' => $org->id,
                'display_name' => $request->displayname,
                'level' => "SubOrg",
                'uuid' => Str::uuid(),
                'status' => $request->status
            ]);
            $specializations = $request->specialization_id;
            foreach ($specializations as $specialization) {
                SpecializedDepartment::Create([
                    'specialization_id' => $specialization,
                    'department_id' => $department->id,
                ]);
            }
            return redirect()->route('hospitalDepartments.list')->withSuccess(__('Successfully Department Created'));
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
            // dd( $organization, $depData);
            return view('hospital_panel.departments.departmentForUpdate', ['organization' => $organization, 'depData' => $depData]);
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function hospitalDepartmentUpdated(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'displayname' => 'required',
            'status' => 'required',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {

            $dep = Department::where('uuid', $request->DepUuid)->first();
            if ($request->hasFile('image')) {
                if (isset($dep) && $dep->image) {
                    $request->validate([
                        'image' => 'nullable|image|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=1140,min_height=650',
                    ]);
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
                'status' => $request->status,
                'display_name' => $request->displayname,
                'image' => $image,
            ]);
            return redirect()->route('hospitalDepartments.list')->withSuccess(__('Department Successfully Updated'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteDepartment($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $orgDb = Department::where('uuid', $uuid)->first();
            if ($orgDb->status == 'Disabled') {
                $orgDb->update(['status' => 'Enabled']);
            } else {
                $orgDb->update(['status' => 'Disabled']);
            }
            return redirect()->back()->withSuccess(__('Successfully Organization Status Updated'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
