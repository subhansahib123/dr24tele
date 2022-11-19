<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin_panel.departments.create', ['organizations' => $organizations]);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $orgName = Organization::where('uuid', $request->organization)->first();
        // dd( $request->name . ' ' . $orgName->name);
        $request->validate([
            'name'  => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
        ]);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $parent_org_uuid = $request->has('input_org') ? $request->input_org : $request->organization;
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name . '_' . $orgName->name,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => $parent_org_uuid
            ],
            "email" => $request->email,
            "contactperson" => '',
            "phone" => '',
            "address" => [
                [
                    "type" => "permanent",
                    "building" => '',
                    "district" => '',
                    "city" => '',
                    "state" => '',
                    "country" => '',
                    "postalCode" => ''
                ]
            ],
            "level" => 'SubOrg',
        ];
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
                'apikey:' . $apiKey,
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
                // dd($organization,$request->all());
                if (
                    isset($organization->displayname)
                    && $organization->displayname
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE) == 201
                 ) {
                    curl_close($curl);
                    // // dd($request->level);
                    $org = Organization::where('uuid',  $parent_org_uuid)->first();
                    Department::Create([
                        'name' => $request->name.'_'.$orgName->name,
                        'organization_id' => $org->id,
                        'slug' => $request->displayname,
                        'level' => "SubOrg",
                        'uuid' => $organization->uuid,
                    ]);
                    return redirect()->back()->withSuccess(__('Successfully Department Created'));
                } else if (isset($organization->message) && $organization->message == "Provided organization name already exist") {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'This Hospital is already having this department']);
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
    public function departmentsList($uuid)
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

        $req_url = $baseUrl . 'rest/admin/organisation/v2/hierarchy/' . $uuid;
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

            //  var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                $departments = json_decode($response);
                // dd($departments);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    if (isset($departments->childlist)) {
                        $org = Organization::where('uuid', $uuid)->first();
                        // foreach ($departments->childlist as $department) {
                        //     Department::firstOrCreate([
                        //         'name' => $department->name,
                        //         'slug' => Str::slug($department->name),
                        //         'organization_id' => $org->id,
                        //         'level' => 'SubOrg',
                        //         'uuid' => $department->uuid
                        //     ]);
                        // }
                        return view('admin_panel.departments.show', ['departments' => $departments]);
                    } else {
                        return redirect()->back()->withErrors(['error' => __('No Record Found')]);
                    }
                } else if (isset($departments->message) && $departments->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $departments->message]);
                } else if (isset($departments->message) && $departments->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $departments->message]);
                } else if (isset($departments->message) && $departments->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $departments->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $departments->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateDepartment(Request $request)
    {


        // dd($request->all());
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
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
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
            "phone" => '',
            "address" => [
                [
                    "type" => "permanent",
                    "building" => '',
                    "district" => '',
                    "city" => '',
                    "state" => '',
                    "country" => '',
                    "postalCode" => ''
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
                $dep = Department::where('uuid', $request->DepUuid)->first();
                $dep->update([
                    'slug' => $request->displayname,

                ]);
                return redirect()->back()->withSuccess(__('Department Successfully Updated'));
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
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
