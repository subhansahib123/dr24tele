<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;
use Illuminate\Support\Str;



class OrganizationController extends Controller
{
    public function organization()
    {


        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/organisation/v2/hierarchy/c6bc6265-e876-414a-9672-a85e09280059',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));


        try {
            // dd($token);
            $response = curl_exec($curl);
            // dd($response);
            $organizations = json_decode($response);
            // dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);

                    // dd($organizations);
                    foreach ($organizations->childlist as $organization) {
                        Organization::firstOrNew(['name'=>$organization->name],[
                            'name' => $organization->name,
                            'slug' => Str::slug($organization->name),
                            'uuid' => $organization->uuid,
                            'status' => $organization->status,
                            'organization_id'=>1
                        ]);
                    }

                    return view('admin_panel.organization.show', ['organizations' => $organizations]);
                } else if (isset($organizations->message) && $organizations->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organizations->message]);
                } else if (isset($organizations->message) && $organizations->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organizations->message]);
                } else if (isset($organizations->message) && $organizations->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organizations->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organizations->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function create()
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return view(
            'admin_panel.organization.create',
            [
                'organizations' => $organizations,
                'countries' => $countries

            ]
        );
    }
    public function createOrganization(Request $request)
    {



        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
            'contactperson' => 'required|string',
            'phone' => 'required|string',
            // 'building' => 'string',
            // 'postalCode' => 'required|string',
            // 'district' => 'required|string',
            // 'city' => 'required|string',
            // 'state' => 'required|string',
            // 'country' => 'required|string',
        ]);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $parent_org_uuid = $request->has('input_org') ? $request->input_org : $request->organization;
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => $parent_org_uuid
            ],
            "email" => $request->email,
            "contactperson" => $request->contactperson,
            "phone" => $request->phone,
            "address" => [
                [
                    "type" => "permanent",
                    "building" => $request->building,
                    "district" => $request->district,
                    "city" => $request->city,
                    "state" => $request->state,
                    "country" => $request->country,
                    "postalCode" => $request->postalCode
                ]
            ],
            "level" => 'SubOrg',
            // "uuid" => $request->organization,
        ];
        // dd($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $baseUrl . 'rest/admin/organisation/v2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));
        try {
            $response = curl_exec($curl);
            // dd($data );
            //  var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {

                $organization = json_decode($response);
                // dd($organization);
                if (
                    isset($organization->displayname)
                    && $organization->displayname
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE) == 201
                ) {
                    curl_close($curl);
                    // // dd($request->level);
                    $org = Organization::where('uuid',  $parent_org_uuid)->first();
                    if ($request->level == 'Department') {

                        // dd($request->organization);
                        Department::Create([
                            'name' => $organization->displayname,
                            'organization_id' => $org->id,
                            'slug' => $request->name,
                            'level' => "SubOrg",
                            'uuid' => $organization->uuid,
                            
                        ]);
                        return redirect()->back()->withSuccess(__('Successfully Department Created'));
                    } else if($request->level == 'Hospital') {
                        Organization::Create([
                            'name' => $request->name,
                            'uuid' => $organization->uuid,
                            'slug' => $organization->displayname,
                            'status' => $organization->status,
                            'level' => "SubOrg",
                            'organization_id' => 1
                        ]);
                        return redirect()->back()->withSuccess(__('Successfully Organization Created'));
                    }


                } else if ($organization->message == "Provided organization name already exist") {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
            }
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

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $url = $baseUrl . 'rest/admin/organisation/v2/' . $orgUuid . '/inactive';
        // dd($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $url,
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
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
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
        // dd(1);
        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];
        $req_url = $baseUrl . 'rest/admin/organisation/v2/' . $uuid;
        $orgData = Organization::where('uuid', $uuid)->first();
        if ($orgData == false) {
            $depData = Department::where('uuid', $uuid)->first();
            $parentOrgId = Organization::where('id', $depData->organization_id)->first();
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization:' . $token,
                'apikey:' . $apiKey
            ),

        ));
        try {
            $response = curl_exec($curl);

            // dd($response);
            $organization = json_decode($response);
            // dd($organization);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $countries = Country::all();
                    if ($orgData == true) {
                        return view('admin_panel.organization.organizationForUpdate', ['organization' => $organization, 'orgData' => $orgData, 'countries' => $countries,]);
                    } else {
                        return view('admin_panel.departments.departmentForUpdate', ['organization' => $organization, 'depData' => $depData, 'parentOrgId' => $parentOrgId]);
                    }
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateOrganization(Request $request)
    {
        // dd($request->all());
        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];

        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'level' => 'SubOrg',
            'contactperson' => 'required|string',
            'phone' => 'required|string',
        ]);
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name,
            "uuid" => $request->OrgUuid,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => $orgId
            ],
            "email" => $request->email,
            "contactperson" => $request->contactperson,
            "phone" => $request->phone,
            "address" => [
                [
                    "type" => "permanent",
                    "building" => $request->building,
                    "district" => $request->district,
                    "city" => $request->city,
                    "state" => $request->state,
                    "country" => $request->country,
                    "postalCode" => $request->postalCode
                ]
            ],
            "level" => 'SubOrg',
            // "uuid" => $request->organization,
        ];
        $req_url = $baseUrl . 'rest/admin/organisation/v2/' . $request->OrgUuid;
        // dd($req_url);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization:' . $token,
                'apikey:' . $apiKey,
            ),
        ));

        try {
            $response = curl_exec($curl);

            // dd($request->all());
            $organization = json_decode($response);
            // dd($organization);

            // dd($organization);
            if ($response == false || isset($response->status)) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $org = Organization::where('uuid', $request->OrgUuid)->first();
                    $org->update([
                        'name' => $request->name,
                        'slug' => $organization->displayname,
                        'status' => $organization->status,
                    ]);
                    return redirect()->back()->withSuccess(__('Organization Successfully Updated'));
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
