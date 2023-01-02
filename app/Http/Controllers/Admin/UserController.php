<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function usersUnmapped()
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
                return redirect()->back()->withErrors(__($error));
            } else {
                $patients = json_decode($response);
                // dd($patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    return view('admin_panel.totalUsers.unmappedUsers', ['patients' => $patients]);
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patients->message]);
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


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {
            $org = Organization::where('uuid', 'c6bc6265-e876-414a-9672-a85e09280059')->first();
            $all_patients = Patient::with('user')->where('organization_id', $org->id)->get();
            // dd($all_patients);
            return view('admin_panel.patients.index', ['all_patients' => $all_patients]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            // return $e->getMessage();
        }
    }
    public function allusersActual()
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            // \DB::enableQueryLog(); // Enable query log

            $orgId = auth()->user()->user_organization->organization_id;
            // dd(auth()->user()->user_organization->organization_id);
            $users = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query ) use($orgId) {
                $query->where('organization_id',$orgId);
            })->get();
            // dd(\DB::getQueryLog()); // Show results of log

            // $orgUsers;
            // dd($users);
            return view('admin_panel.user.users', ['users' => $users]);
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

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
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
                    return redirect()->route('logout')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $all_patients->message]);
                } else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('logout')->withError(['error' => $all_patients->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $all_patients->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function create_user($uuid)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        return view('admin_panel.all_patients.create',['orgId'=>$uuid]);
    }
    public function store_user(Request $request)
    {
        // dd($request->orgId);
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'image' => 'required|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=300,min_height=350',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/organization/management/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }
        // dd($image);

        try {

            $user = User::firstOrCreate([
                'username' => $request->username,
                'name' => $request->name . ' ' . $request->middlename,
                'password' => $request->password,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonId' => Str::uuid(),
                'status' => 1,
                'image' => $image

            ]);
            // dd($user);
            $orgId=$request->orgId;
            return $this->mapUser($user,$orgId);
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

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
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


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function mapUser($user,$orgId)
    {
        $roles = Role::all();
        $orgId=Organization::where('uuid',$orgId)->first();
        $orgId=$orgId->id;
// dd($orgId);
        return view('admin_panel.totalUsers.roleEdit', ['user' => $user, 'roles' => $roles, 'orgId'=>$orgId]);
    }



    public function mapUserRole(Request $request)
    {


        
        
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {
            $user = User::where('uuid', $request->user)->first();
            $role = Role::where('name', $request->role)->first();
            $organization = Organization::where('id', $request->orgId)->first();
            // dd($user->id, $role->id, $organization->id,$department->id);
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

            if($organization->uuid=='c6bc6265-e876-414a-9672-a85e09280059'){
            return redirect()->route('users.all.actual')->withSuccess(__('Successfully Created User'));

            }
            return redirect()->route('users.list',[$organization->uuid])->withSuccess(__('Successfully Created User'));
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function updateUserRole($orgUuid, $userUuid)
    {
        $user = User::where('uuid', $userUuid)->first();
        $roles = Role::all();
        $uuid = $orgUuid;
        // dd($uuid,$user);
        return view('admin_panel.totalUsers.updateRole', ['user' => $user, 'roles' => $roles, 'uuid' => $uuid]);
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
                // dd($UpdatedRole);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    // dd($UpdatedRole[0]->useruuid);
                    $user = User::where('uuid', $UpdatedRole[0]->useruuid)->first();
                    $role = Role::where('name', $UpdatedRole[0]->rolename)->first();
                    // dd($userRole->id);
                    User_Role::firstOrCreate(['role_id' => $role->id, 'user_id' => $user->id]);
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
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function doctorsList($uuid)
    {
        // dd($uuid);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $dep = Department::where('uuid', $uuid)->first();
            $doctors = Doctor::with('user')->where('department_id', $dep->id)->get();
            // dd($doctors);
            return view('admin_panel.doctors.showDoctors', ['doctors' => $doctors,'uuid'=>$uuid]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            // return $e->getMessage();
        }
    }
    public function usersList($uuid)
    {
        $org = Organization::where('uuid', $uuid)->first();
        $users = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query ) use($org) {
            $query->where('organization_id',$org->id);
        })->get();
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
            return view('admin_panel.organization.usersList', ['users' => $users,'uuid'=>$uuid]);
    }

    public function updateUser($uuid, $username, $name)
    {

        return view('admin_panel.user.updateUser', ['uuid' => $uuid, 'username' => $username, 'name' => $name]);
    }
    public function  userUpdated(Request $request)
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
    public function doctorDelete($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $user = User::where('uuid', $uuid)->first();
            if ($user) {
                UsersOrganization::where('user_id', $user->id)->delete();
                User_Role::where('user_id', $user->id)->delete();
                $doctor = Doctor::where('user_id', $user->id)->delete();
                if (isset($user) && $user->image) {
                    $previous_img = public_path('uploads/organization/department/doctor/' . $user->image);
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                }
                $user->delete();
            }
            return redirect()->back()->withSuccess(__('Doctor Successfully  Deleted'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function userDelete($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {


            $user = User::where('uuid', $uuid)->first();
            if ($user) {
                UsersOrganization::where('user_id', $user->id)->delete();
                User_Role::where('user_id', $user->id)->delete();
                $user->delete();
            }
            return redirect()->back()->withSuccess(__('Management Successfully  Deleted'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
