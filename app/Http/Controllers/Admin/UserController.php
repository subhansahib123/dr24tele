<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Doctor;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $userInfo = session('loggedInUser');
    //     $userInfo = json_decode(json_encode($userInfo), true);
    //     if (is_null($userInfo))
    //         return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);

    // }

    // Function that show list of All Unmapped Patients
    public function usersUnmapped()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

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
                return redirect()->back()->withErrors(__($error));
            } else {
                $patients = json_decode($response);
                // dd($patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('admin_panel.totalUsers.unmappedUsers', ['patients' => $patients]);
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $patients->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function allusers()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/orgPersonMapping/persons/c6bc6265-e876-414a-9672-a85e09280059',
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
                    // dd($all_patients);
                    return view('admin_panel.totalUsers.index', ['all_patients' => $all_patients]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
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
    public function allusersActual()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }


        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgUserMapping/users?pageNo=1&maxRecords=50',
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
                return redirect()->back()->withErrors(['error' => __($error)]);
            } else {
                $all_patients = json_decode($response);
                // dd($all_patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('admin_panel.user.users', ['all_patients' => $all_patients]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
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
    public function allUnmappedUsersActual()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgUserMapping/users/floating',
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
                // dd($all_patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('admin_panel.user.umappedUser', ['all_patients' => $all_patients]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('login.show')->withError(['error' => $all_patients->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $all_patients->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function create_user()
    {
        return view('admin_panel.all_patients.create');
    }
    public function store_user(Request $request)
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
        if (is_null($userInfo)) {

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
                    // dd(1);
                    User::create([
                        'username' => $user->username,
                        'password' => $request->password,
                        'email' => $request->name,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'status' => 1

                    ]);
                    return redirect()->back()->withSuccess(__('Successfully Created User'));
                } else if (isset($user->message) && $user->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('login.show')->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $user->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $user->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function mapAdminUser()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin_panel.totalUsers.roleAdminUser', ['users' => $users, 'roles' => $roles]);
    }
    public function adminUserMapped(Request $request)
    {

        $curl = curl_init();
        $uuid = 'c6bc6265-e876-414a-9672-a85e09280059';


        // dd($uuid);
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }


        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];
        // dd($request->all());
        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/add/' . $uuid;
        // dd($req_url);
        // dd($uuid);
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
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $request->user)->first();
                    $role = Role::where('name', $request->role)->first();
                    $department = Department::where('uuid', $request->department)->first();
                    $organization = Organization::where('uuid', 'c6bc6265-e876-414a-9672-a85e09280059')->first();
                    curl_close($curl);
                    if ($request->role == 'Practitioner') {

                        Doctor::firstOrCreate([

                            'status' => 1,
                            'user_id' => $user->id,
                            'department_id' => $department->id
                        ]);
                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $organization->id
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    } else if ($request->role == 'OrgSuperAdmin') {

                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);

                        // dd($user->id,$role->id,$organization->id);

                    } else if ($request->role == 'FrontOffice ') {

                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $organization->id
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
                            'organization_id' => $organization->id
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    }

                    return redirect()->back()->withSuccess(__('Successfully Mapped User Role'));
                } else if (isset($userRole->message) && $userRole->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $userRole->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function mapUser()
    {
        $users = User::all();
        $roles = Role::all();
        $organizations = Organization::all();
        // dd($roles);
        return view('admin_panel.totalUsers.roleEdit', ['users' => $users, 'roles' => $roles, 'organizations' => $organizations]);
    }



    public function mapUserRole(Request $request)
    {

        $curl = curl_init();
        $uuid = '';
        if ($request->department != '') {
            $uuid = $request->department;
        } else {
            $uuid = $request->organizations;
        }

        // dd($uuid);
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];
        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/add/' . $uuid;
        // dd($req_url);
        // dd($uuid);
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
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $request->user)->first();
                    $role = Role::where('name', $request->role)->first();
                    $department = Department::where('uuid', $request->department)->first();
                    $organization = Organization::where('uuid', $request->organizations)->first();;
                    curl_close($curl);
                    if ($request->role == 'Practitioner') {

                        Doctor::firstOrCreate([

                            'status' => 1,
                            'user_id' => $user->id,
                            'department_id' => $department->id
                        ]);
                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $organization->id
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
                            'organization_id' => $organization->id
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);

                        // dd($user->id,$role->id,$organization->id);

                    } else if ($request->role == 'FrontOffice ') {

                        UsersOrganization::firstOrCreate([

                            'status' => 1,
                            'registration_code' => '123ABC',
                            'user_id' => $user->id,
                            'organization_id' => $organization->id
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
                            'organization_id' => $organization->id
                        ]);
                        User_Role::firstOrCreate([
                            'user_id' => $user->id,
                            'role_id' => $role->id
                        ]);
                    }

                    return redirect()->back()->withSuccess(__('Successfully Mapped User Role'));
                } else if (isset($userRole->message) && $userRole->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else if (isset($userRole->message) && $userRole->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $userRole->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' =>  $userRole->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateUserRole($uuid)
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin_panel.totalUsers.updateRole', ['users' => $users, 'roles' => $roles, 'uuid' => $uuid]);
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
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $UpdatedRole = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    // dd($UpdatedRole[0]->useruuid);
                    $user = User::where('uuid', $UpdatedRole[0]->useruuid)->first();
                    $role = Role::where('name', $UpdatedRole[0]->rolename)->first();
                    $userRole = User_Role::where('user_id', $user->id)->first();
                    // dd($userRole->id);
                    $userRole->update(['role_id' => $role->id]);
                    return redirect()->back()->withSuccess(__('Successfully User Role Updated'));
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('login.show')->withErrors(['error' => $UpdatedRole->message]);
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $UpdatedRole->message]);
                } else if (isset($UpdatedRole->message) && $UpdatedRole->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $UpdatedRole->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function doctorsList($uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

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
                    return view('admin_panel.doctors.showDoctors', ['doctors' => $doctors]);
                } else if (isset($doctors->message) && $doctors->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $doctors->message]);
                } else if (isset($doctors->message) && $doctors->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $doctors->message]);
                } else if (isset($doctors->message) && $doctors->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $doctors->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' =>   $doctors->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            // return $e->getMessage();
        }
    }
    public function usersList($uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

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
                $users = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('admin_panel.organization.usersList', ['users' => $users]);
                } else if (isset($users->message) && $users->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' =>  $users->message]);
                }
            }
        } catch (\Exception $e) {
            // dd(__($e->getMessage()));
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            // return $e->getMessage();
        }
    }
    public function deleteUser($uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
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
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else if (isset($users->message) && $users->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $users->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $users->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateUser($uuid, $username, $name)
    {

        return view('admin_panel.user.updateUser', ['uuid' => $uuid, 'username' => $username, 'name' => $name]);
    }
    public function userUpdated(Request $request)
    {
        // dd($request->all());
        if (isset($request->username) && isset($request->name) && isset($request->password)) {
            dd(1);
        } else if (isset($request->username) && isset($request->name) && ($request->password != true)) {
            dd(2);
        } else if (isset($request->username) && isset($request->password) && ($request->name != true)) {
            dd(3);
        } else if (isset($request->password) && isset($request->name) && ($request->username != true)) {
            dd(4);
        } else if (isset($request->username) && ($request->name != true) && ($request->password != true)) {
            dd(5);
        } else if (($request->username != true) && isset($request->password) && ($request->name != true)) {
            dd(6);
        } else if (($request->password != true) && isset($request->name) && ($request->username != true)) {
            dd(7);
        } else {
            return redirect()->back()->withErrors(['error' => 'Please fill form Correctly to Update User ']);
        }
    }
}
