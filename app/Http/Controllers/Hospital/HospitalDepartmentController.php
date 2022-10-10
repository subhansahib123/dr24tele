<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Support\Str;


class HospitalDepartmentController extends Controller
{
    public function createHospitalDepartment()
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return view(
            'hospital_panel.departments.create',
            [
                'organizations' => $organizations,

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
            'contactperson' => 'required|string',
            'phone' => 'required|string',
            'building' => 'string',
            'postalCode' => 'required|string',
            'district' => 'required|string',
        ]);
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
        $orgId = $userInfo['sessionInfo']['orgId'];
        $org = Organization::where('uuid', $orgId)->first();
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name,
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
                    "postalCode" => $request->postalCode
                ]
            ],
            "level" => 'SubOrg',
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


                    Department::Create([
                        'name' => $request->name,
                        'organization_id' => $org->id,
                        'slug' => $organization->displayname,
                        'level' => "SubOrg",
                        'uuid' => $organization->uuid,
                    ]);
                    return redirect()->back()->withSuccess(__('Successfully Department Created'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => 'API rate limit exceeded.']);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);


                    return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function hospitalDepartmentsList()
    {

        // dd($uuid);
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
        $orgId = $userInfo['sessionInfo']['orgId'];

        // dd($orgId);
        $req_url = $baseUrl . 'rest/admin/organisation/v2/hierarchy/' . $orgId;
        // dd($apiKey);
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
                'Authorization: ' . $token,
                'apikey: ' . $apiKey,
            ),
        ));

        try {
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                $departments = json_decode($response);
                // dd($departments);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    // dd($departments);
                    curl_close($curl);
                    $org = Organization::where('uuid', $orgId)->first();

                    if (isset($departments->childlist)) {
                        foreach ($departments->childlist as $department) {
                            Department::firstOrCreate([
                                'name' => $department->name,
                                'slug' => Str::slug($department->name),
                                'organization_id' => $org->id,
                                'level' => 'SubOrg',
                                'uuid' => $department->uuid
                            ]);
                            return view('hospital_panel.departments.show', ['departments' => $departments]);
                        }
                    } else {
                        return redirect()->back()->withErrors(['error' => 'No Record Found']);
                    }
                    // return redirect()->back()->withSuccess(__('Successfully Department List Fetched'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $departments->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $departments->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $departments->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $departments->message]);
                } else if (isset($departments->message) && $departments->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $departments->message]);
                } else if (isset($departments->message) && $departments->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $departments->message]);
                } else if (isset($departments->message) && $departments->message == "Invalid Token") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $departments->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function updateHospitalDepartment($uuid)
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
        $req_url = $baseUrl . 'rest/admin/organisation/v2/' . $uuid;
        $depData = Department::where('uuid', $uuid)->first();
        $parentOrgId = Organization::where('id', $depData->organization_id)->first();

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

                    return view('hospital_panel.departments.departmentForUpdate', ['organization' => $organization, 'depData' => $depData, 'parentOrgId' => $parentOrgId]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else if (isset($organization->message) && $organization->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $organization->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function hospitalDepartmentUpdated(Request $request)
    {
        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($request->all());
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
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
            "uuid" => $request->DepUuid,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => $request->parentOrgId
            ],
            "email" => $request->email,
            "contactperson" => '',
            "phone" => $request->phone,
            "address" => [
                [
                    "type" => "permanent",
                    "building" => $request->building,
                    "district" => $request->district,
                    "postalCode" => $request->postalCode
                ]
            ],
            "level" => 'SubOrg',
        ];
        $req_url = $baseUrl . 'rest/admin/organisation/v2/' . $request->DepUuid;
        // dd($data);

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
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                curl_close($curl);
                    $dep=Department::where('uuid',$request->DepUuid)->first();
                    $dep->update([
                        'name' => $organization->displayname,

                    ]);
                    return redirect()->back()->withSuccess(__('Department Successfully Updated'));
            } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $organization->message]);
            } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $organization->message]);
            } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 404) {
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $organization->message]);
            }else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $organization->message]);
            }else if (isset($organization->message) && $organization->message == "API rate limit exceeded") {
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $organization->message]);
            }else if (isset($organization->message) && $organization->message == "Invalid User") {

                curl_close($curl);
                return redirect()->route('logout')->withErrors(['error' => $organization->message]);
            }  else if (isset($organization->message) && $organization->message == "Invalid Token") {

                curl_close($curl);
                return redirect()->route('logout')->withErrors(['error' => $organization->message]);
            } else {
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
