<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentSpecializations;
use App\Models\Organization;
use App\Models\SpecializedDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index($uuid)
    {
        $organizations = Organization::all();
        $specializations = DepartmentSpecializations::all();
        // dd($specializations);
        return view('admin_panel.departments.create', ['organizations' => $organizations, 'specializations' => $specializations,'uuid'=>$uuid]);
    }
    public function create(Request $request)
    {
        // dd($request->email());

        $organization = Organization::where('uuid', $request->orgId)->first();
        // dd( $orgName->id );
        $request->validate([
            'displayname' => 'required',
            'status' => 'required',
            'specialization_id.*' => 'required',
            'image' => 'required|image|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=1140,min_height=650'

        ]);
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/organization/department/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        // $parent_org_uuid = $request->has('input_org') ? $request->input_org : $request->organization;
        // dd($parent_org_uuid);

        try {
            $dep = Department::firstOrCreate([
                'name' =>strtolower(str_replace(' ','',$request->displayname)). '_' .$organization->name,
                'organization_id' => $organization->id,
                'display_name' => $request->displayname,
                'status' => $request->status,
                'image' => $image,
                'level' => "SubOrg",
                'uuid' => Str::uuid(),
            ]);
            // dd($department);
            $specializations = $request->specialization_id;
            // dd($specializations,$department);
            foreach ($specializations as $specialization) {
                // dd($specialization);
                SpecializedDepartment::Create([
                    'specialization_id' => $specialization,
                    'department_id' => $dep->id,
                ]);

                // dd($org->uuid);
                return redirect()->route('departments.list', [$organization->uuid])->withSuccess(__('Successfully Department Created'));
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
            return view('admin_panel.departments.show', ['departments' => $departments,'uuid'=>$uuid]);
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
            'name' => 'required',
            'status' => 'required',
        ]);
        try {
            $dep = Department::where('uuid', $request->DepUuid)->first();
            if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=1140,min_height=650',]);
                if (isset($dep) && $dep->image) {
                    $previous_img = public_path('uploads/organization/department/' . $dep->image);
                    // dd($previous_img);
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                }
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/') . date('Y'), $getImage);
                $image = $getImage;
            }
            $dep->update([
                'display_name' => $request->displayname,
                'status' => $request->status,
                'image' => $dep->image

            ]);
            $org = Organization::where('id', $dep->organization_id)->first();
            // dd($org);
            return redirect()->route('departments.list', [$org->uuid])->withSuccess(__('Successfully Department Updated'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
