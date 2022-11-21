<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Doctor;
use App\Models\Country;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\Hash;

class HospitalUserController extends Controller
{
    public function allHospitalUsers()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];

        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgUserMapping/users/' . $orgId . '?pageNo=1&maxRecords=50',
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
                'apikey:' . $apiKey,
            ),
        ));

        try {
            $response = curl_exec($curl);


            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => __($error)]);
            } else {
                $all_patients = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('hospital_panel.totalUsers.index', ['all_patients' => $all_patients]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('logout') > withError(__($all_patients->message));
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $all_patients->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            // return $e->getMessage();
        }
    }
    public function hospitalUnmappedUsers()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/orgPersonMapping/persons/floating',
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
                'apikey:' . $apiKey,
            ),
        ));

        try {
            $response = curl_exec($curl);
            // dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->view('hospital_panel.totalUsers.unmappedUsers')->withError(__($error));
            } else {
                $patients = json_decode($response);
                // dd($patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('hospital_panel.totalUsers.unmappedUsers', ['patients' => $patients]);
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid User") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' =>  $patients->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function createHospitalUser()
    {


        return view('hospital_panel.user.create');
    }
    public function storeHospitalUser(Request $request)
    {
        // dd($request->all());
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $data = [
            'user' => [
                'username' => $request->username,
                'password' => $request->password
            ],
            'person' => [
                'givenName' => $request->name,
                'middleName' => $request->middlename,
                'email' => $request->email,
                'gender' => [
                    'genderCode' => $request->gender_code,
                ],
                'phoneNumber' => $request->phoneNumber,
                'dateOfBirth' => $request->dateOfBirth,

            ]
        ];
        // dd($data);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];
        $organis_db = Organization::where('uuid', $orgId)->first();
        // dd($organis_db);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/user',
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
                'Authorization: ' . $token,
                'apikey:' . $apiKey
            ),
        ));

        try {
            $response = curl_exec($curl);


            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $user = json_decode($response);
                // dd($user);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);


                    $user = User::firstOrCreate([
                        'username' => $user->username,
                        'password' => $request->password,
                        'name' => $user->name,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'email' => $request->email,
                        'PersonId' => $user->personId,
                        'status' => 1

                    ]);
                    UsersOrganization::firstOrCreate([

                        'status' => 1,
                        'registration_code' => '123ABC',
                        'user_id' => $user->id,
                        'organization_id' => $organis_db->id,
                    ]);
                    // dd(1);
                    return $this->mapHospitalUser();
                } else if (isset($user->message) && $user->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('logout')->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $user->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $user->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function mapHospitalUser()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $orgId = $userInfo['sessionInfo']['orgId'];
        $org = Organization::where('uuid', $orgId)->first();
        $user_ids = UsersOrganization::where('organization_id', $org->id)->get('user_id')->toArray();
        // dd($user_ids);
        $ar_ids = [];
        foreach ($user_ids as $user_id) {
            if (!isset($user_id['user_id'])) continue;
            array_push($ar_ids, $user_id['user_id']);
        }

        $users = User::whereIn('id', $ar_ids)->get();
        // dd($users);
        $roles = Role::all();
        // dd($roles);

        $departments = Department::where('organization_id', $org->id)->get();
        // dd($org->id);
        return view('hospital_panel.totalUsers.roleEdit', ['users' => $users, 'roles' => $roles, 'departments' => $departments, 'org' => $org]);
    }
    public function hospitalUserMapped(Request $request)
    {


        $curl = curl_init();
        // dd($request->all());
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];

        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];


        if (isset($request->department)) {
            $orgId = $request->department;
        }


        $req_url = $baseUrl . 'rest/admin/orgUserMapping/role/add/' . $orgId;
        // dd($req_url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));
        try {
            $uuid = $request->user;

            $response = curl_exec($curl);
            // dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);


                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd($userRole,$request->user,$request->role);
                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $request->user)->first();
                    $role = Role::where('name', $request->role)->first();
                    // dd($role->id);
                    curl_close($curl);

                    User_Role::firstOrCreate([
                        'user_id' => $user->id,
                        'role_id' => $role->id
                    ]);
                    return redirect()->route('createHospital.user')->withSuccess(__('Successfully User Created'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);

                    return redirect()->route('updatingUser.role', ['uuid' => $uuid]);
                } else if (isset($userRole->message) && $userRole->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('logout')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $userRole->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $userRole->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }

    public function hospitalDoctorsList($uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        // dd($uuid);
        $token = $userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgUserMapping/users/' . $uuid . '?pageNo=1&maxRecords=200',
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
                'apikey: ' . $apiKey
            ),
        ));
        try {
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false) {

                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $doctors = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    // dd($doctors);
                    return view('hospital_panel.doctors.showDoctors', ['doctors' => $doctors]);
                } else if (isset($doctors->message) && $doctors->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('logout')->withErrors(['error' => $doctors->message]);
                } else if (isset($doctors->message) && $doctors->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $doctors->message]);
                } else if (isset($doctors->message) && $doctors->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $doctors->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $doctors->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    public function deleteHospitalDoctor($uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/user/' . $uuid,
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
                'apikey: ' . $apiKey
            ),
        ));
        try {
            $response = curl_exec($curl);


            if ($response == false) {

                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $users = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $user = User::where('uuid', $uuid)->first();
                    if ($user) {
                        UsersOrganization::where('user_id', $user->id)->delete();
                        User_Role::where('user_id', $user->id)->delete();
                        if ($user->doctor)
                            Doctor::where('user_id', $user->id)->delete();
                        $user->delete();
                    }
                    return redirect()->back()->withSuccess(__('Successfully Delete User'));
                } else if (isset($users->message) && $users->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $users->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $users->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function updateHospitalUserRole($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $roles = Role::all();
        // dd($user);
        return view('hospital_panel.totalUsers.updateRole', ['user' => $user, 'roles' => $roles]);
    }
    public function updateUserRoleStore(Request $request)
    {

        // dd($request->all());
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];
        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/update/' . $orgId;
        // dd($req_url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
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

                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $UpdatedRole = json_decode($response);
                // dd($UpdatedRole);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $user = User::where('uuid', $UpdatedRole[0]->useruuid)->first();
                    $role = Role::where('name', $UpdatedRole[0]->rolename)->first();
                    // dd($user->id,$role->id);
                    User_Role::firstOrCreate([
                        'role_id' => $role->id,
                        'user_id' => $user->id
                    ]);
                    return redirect()->back()->withSuccess(__('Successfully User Role Updated'));
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "API rate limit exceeded") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $UpdatedRole->message]);
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $UpdatedRole->message]);
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $UpdatedRole->message]);
                } else {
                    curl_close($curl);

                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    public function updateHospital()
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
        // dd($token);
        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        $req_url = $baseUrl . 'rest/admin/organisation/v2/' . $orgId;
        $orgData = Organization::where('uuid', $orgId)->first();

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
            if ($response == false) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    // dd($organization);
                    curl_close($curl);
                    $countries = Country::all();
                    return view('hospital_panel.hospital.updateHospital', ['organization' => $organization, 'orgData' => $orgData, 'countries' => $countries,]);
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


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function hospitalUpdated(Request $request)
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

        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'contactperson' => 'required|string',
            'phoneNumber' => 'required|string',
        ]);
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name,
            "uuid" => $request->$orgId,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => 'c6bc6265-e876-414a-9672-a85e09280059'
            ],
            "email" => $request->email,
            "contactperson" => $request->contactperson,
            "phone" => $request->phoneNumber,
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
            ]
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
            if ($response == false) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $org = Organization::where('uuid', $request->OrgUuid)->first();
                    $org->update([
                        'slug' => $organization->displayname,
                        'status' => $organization->status,
                    ]);
                    return redirect()->back()->withSuccess(__('Hospital Successfully Updated'));
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
                    return redirect()->back()->withErrors(['error' =>  $organization->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function updatePassword()
    {
        return view('hospital_panel.profile.updatePassword');
    }
    public function passwordUpdated(Request $request)
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
        $data = ['currentpassword' => $request->currentpassword, 'newpassword' => $request->newpassword,];
        // dd($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/user/changePassword',
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
                'apikey: ' . $apiKey
            ),
        ));

        try {
            $response = curl_exec($curl);
            $password = json_decode($response);
            // dd($password);
            $response ='Success !! A password changed sucessfully';
            if ($response == false) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                if ($response == 'Success !! A password changed sucessfully') {
                    curl_close($curl);
                    // dd(1);
                    return redirect()->back()->withSuccess(__('Password Update Successfully'));
                 } 
                //else if (isset($password->message) && $password->message == "API rate limit exceeded") {
                //     curl_close($curl);

                //     return redirect()->route('logout')->withErrors(['error' => __($password->message)]);
                // } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {

                //     curl_close($curl);
                //     return redirect()->route('logout')->withErrors(['error' => __($password->message)]);
                // } else if (isset($password->message) && $password->message == "Invalid User") {

                //     curl_close($curl);
                //     return redirect()->route('logout')->withErrors(['error' => $password->message]);
                // } else if (isset($password->message) && $password->message == "Invalid Token") {

                //     curl_close($curl);
                //     return redirect()->route('logout')->withErrors(['error' => $password->message]);
                // } else {


                //     curl_close($curl);
                //     return redirect()->back()->withErrors(['error' => $password->message]);
                // }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
