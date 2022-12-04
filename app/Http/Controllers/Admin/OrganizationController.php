<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class OrganizationController extends Controller
{
    public function organization()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $organizations = Organization::orderBy('id', 'desc')->get();
            return view('admin_panel.organization.show', ['organizations' => $organizations]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function create()
    {
        $countries = Country::all();
        $organizations = Organization::all();
        return view('admin_panel.organization.create', ['countries' => $countries, 'organizations' => $organizations]);
    }

    public function createOrganization(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'displayname' => 'required|string',
            'contactperson_designation' => 'string',
            'contactperson' => 'required|string',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'required',
            'building' => 'string',
            'status' => 'required',
            'district' => 'string',
            'postalCode' => 'string',
            'image' => 'required|mimes:jpg,png,gif,svg,jpeg'
        ]);
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/organization/') . date('Y'), $getImage);
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
        $parent_org = Organization::where('uuid', $parent_org_uuid)->first();
        try {
            Organization::Create([
                'name' => $request->name,
                'uuid' => Str::uuid(),
                'slug' => $request->displayname,
                'status' => $request->status,
                'level' => "SubOrg",
                'image' => $image,
                'organization_id' => $parent_org->id,

                'displayname' => $request->displayname,
                'contactperson_designation' => $request->contactperson_designation,
                'contactperson' => $request->contactperson,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'email' => $request->email,
                'building' => $request->building,
                'district' => $request->district,
                'postalCode' => $request->postalCode
            ]);
            return redirect()->back()->withSuccess('Successfully Created');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function states($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function cities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function getDepartments($orgUuid)
    {
        $org = Organization::where('uuid', $orgUuid)->first();
        $departments = Department::where('organization_id', $org->id)->get();
        return response()->json($departments);
    }

    public function deleteOrganisation($orgUuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $url = $baseUrl . 'rest/admin/organisation/v2/' . $orgUuid . '/inactive';
        // dd($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));
        try {
            $response = curl_exec($curl);


            // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            $organization = json_decode($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                // dd($organization);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $orgDb = Organization::where('uuid', $orgUuid)->first();
                    if ($orgDb) {
                        $orgDb->update(['status' => 'Disabled']);
                        return redirect()->back()->withSuccess(__('Successfully Organization marked Inactive'));
                    } else {
                        Department::where('uuid', $orgUuid)->delete();
                        return redirect()->back()->withSuccess(__('Successfully Department marked Inactive'));
                    }
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function singleOrganization($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $orgData = Organization::where('uuid', $uuid)->first();
        if ($orgData == false) {
            $depData = Department::where('uuid', $uuid)->first();
            $parentOrgId = Organization::where('id', $depData->organization_id)->first();
        }
        try {
            $countries = Country::orderBy('id', 'desc')->get();
            if ($orgData == true) {
                return view('admin_panel.organization.organizationForUpdate', ['orgData' => $orgData, 'countries' => $countries,]);
            } else {
                // dd($depData,$parentOrgId);

                return view('admin_panel.departments.departmentForUpdate', ['depData' => $depData, 'parentOrgId' => $parentOrgId]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function updateOrganization(Request $request)
    {

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $request->validate([
            'displayname' => 'required|string',
            'contactperson_designation' => 'string',
            'contactperson' => 'required|string',
            'email' => 'required',
            'building' => 'string',
            'status' => 'required|string',
            'district' => 'string',
            'postalCode' => 'string',
            'image' => 'nullable|image|mimes:jpg,png,gif,svg,jpeg'
        ]);
        try {
            $org = Organization::where('uuid', $request->uuid)->first();
            if ($request->hasFile('image')) {
                if(isset($org) && $org->image){
                    $previous_img = public_path('uploads/organization/'.$org->image);
                    if(File::exists($previous_img)){
                        File::delete($previous_img);
                    }
                }
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/') . date('Y'), $getImage);
                $image = $getImage;
            }
            else{
                $image = $org->image;
            }

            $org->update([
                'status' => $request->status,
                'image' => $image,
                'displayname' => $request->displayname,
                'contactperson_designation' => $request->contactperson_designation,
                'contactperson' => $request->contactperson,
                'email' => $request->email,
                'building' => $request->building,
                'district' => $request->district,
                'postalCode' => $request->postalCode
            ]);
            return redirect()->back()->withSuccess(__('Organization Successfully Updated'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
