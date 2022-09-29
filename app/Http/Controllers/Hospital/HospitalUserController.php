<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Doctor;
use App\Models\User_Role;
use App\Models\UsersOrganization;

class HospitalUserController extends Controller
{
    public function allHospitalUsers()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/orgPersonMapping/persons/' . $orgId,
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
                } else if (isset($all_patients->message) && $all_patients->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => 'Invalid Token.']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Provided password does not match the password policy / User already exists / User name missing in the request / Please provide name']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not authorized to create user']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Failed to serialize to JSON']);
                } else if (isset($all_patients->message) && $all_patients->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withError(__('API rate limit exceeded.'));
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Unknown Error From Api.')]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withError(__($e->getMessage()));
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
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
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
                if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'API rate limit exceeded.']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('hospital_panel.totalUsers.unmappedUsers', ['patients' => $patients]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Failed to serialize to JSON object']);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => __('Unknow Error From Api.')]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->view('hospital_panel.totalUsers.unmappedUsers')->withError(__($e->getMessage()));
        }
    }
    public function createHospitalUser()
    {
        return view('hospital_panel.user.create');
    }
    public function storeHospitalUser(Request $request)
    {
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
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];

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
                // dd($users);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);

                    User::create([
                        'username' => $user->username,
                        'password' => \Hash::make($request->password),
                        'email' => $user->username,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'status' => 1

                    ]);
                    return redirect()->back()->withSuccess(__('Successfully Created User'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Provided password does not match the password policy / User already exists / User name missing in the request / Please provide name']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not authorized to create user']);
                } else if (isset($user->message) && $user->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($user->message) && $user->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {

                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Failed to serialize to JSON']);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Unknow Error From Api.')]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function mapHospitalUser()
    {
        $users = User::all();
        $roles = Role::all();
        // dd($roles);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $orgId = $userInfo['sessionInfo']['orgId'];
        $org = Organization::where('uuid', $orgId)->first();
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
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];

        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];


        if (isset($request->department)) {
            $orgId = $request->department;
        }


        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/add/' . $orgId;
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
            // dd($request->organizations);
            $response = curl_exec($curl);
            // dd($response);

            // dd($dep);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                // dd($error);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd($userRole);
                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {

                    $user = User::where('uuid', $request->user)->first();
                    $role = Role::where('name', $request->role)->first();
                    $department = Department::where('uuid', $request->department)->first();
                    // dd($user->id);
                    curl_close($curl);
                    if ($request->role == 'Practitioner') {
                        if (isset($request->department)) {
                            Doctor::firstOrCreate([

                                'status' => 1,
                                'user_id' => $user->id,
                                'department_id' => $department->id
                            ]);
                        }
                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $request->org,
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    } else if ($request->role == 'OrgSuperAdmin') {

                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $request->org
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    } else if ($request->role == 'FrontOffice ') {

                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $request->org
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    } else {

                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $request->org
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    }

                    return redirect()->back()->withSuccess(__('Successfully Mapped User Role'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);

                    return redirect()->route('updatingUser.role', [$orgId]);
                    // return redirect()->back()->withErrors(['error' => 'User role already exists']);
                } else if (isset($userRole->message) && $userRole->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($userRole->message) && $userRole->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());

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
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        // dd($uuid);
        $token = $userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgUserMapping/users/' . $uuid . '?pageNo=1&maxRecords=50',
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
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $doctors->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $doctors->message]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    public function updateHospitalUserRole($dep)
    {
        $users = User::all();
        $roles = Role::all();

        return view('hospital_panel.totalUsers.updateRole', ['users' => $users, 'roles' => $roles, 'uuid' => $dep]);
    }
    public function updateUserRoleStore(Request $request)
    {

        // dd($request->all());
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];
        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/update/' . $request->uuid;
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
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $UpdatedRole = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);

                    return redirect()->back()->withSuccess(__('Successfully User Role Updated'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    dd(1);
                    return redirect()->back()->withErrors(['error' => 'User role already exists']);
                } else {
                    curl_close($curl);

                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
}
