<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Doctor;
use App\Models\Country;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;

class HospitalUserController extends Controller
{
    public function allHospitalUsers()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $orgId = auth()->user()->user_organization->organization_id;
        // dd(auth()->user()->user_organization->organization_id);
        $all_patients = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query) use ($orgId) {
            $query->where('organization_id', $orgId);
        })->get();

        return view('hospital_panel.totalUsers.index', ['all_patients' => $all_patients]);
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
        $orgId = auth()->user()->user_organization->organization_id;
        try {
            $patients = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query ) use($orgId) {
                $query->where('organization_id',$orgId);
            })->get();
            return view('hospital_panel.totalUsers.unmappedUsers', ['patients' => $patients]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public
    function createHospitalUser()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        return view('hospital_panel.user.create');
    }

    public
    function storeHospitalUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $organis_db = \auth()->user()->user_organization->organization;
        try {
            $user = User::firstOrCreate([
                'username' => $request->username,
                'password' => $request->password,
                'name' => $request->name,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'email' => $request->email,
                'PersonId' => Str::uuid(),
                'status' => 1

            ]);
            UsersOrganization::firstOrCreate([
                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $user->id,
                'organization_id' => $organis_db->id,
            ]);
            // dd($user );
            return $this->mapHospitalUser($user);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public
    function mapHospitalUser($user)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $org = \auth()->user()->user_organization->organization;
        $roles = Role::all();
        $departments = Department::where('organization_id', $org->id)->get();
        return view('hospital_panel.totalUsers.roleEdit', ['user' => $user, 'roles' => $roles, 'departments' => $departments,]);
    }

    public
    function hospitalUserMapped(Request $request)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $orgId = \auth()->user()->user_organization->organization;
        try {
            $user = User::where('uuid', $request->user)->first();
            $role = Role::where('name', $request->role)->first();

            User_Role::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => $role->id
            ]);
            return redirect()->route('createHospital.user')->withSuccess(__('Successfully User Created'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public
    function hospitalDoctorsList($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $dep = Department::where('uuid', $uuid)->first();
            $doctors = Doctor::with('user')->where('department_id', $dep->id)->get();
                // dd($doctors);
                return view('hospital_panel.doctors.showDoctors', ['doctors' => $doctors]);


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }

    public
    function deleteHospitalDoctor($uuid)
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

    public
    function updateHospitalUserRole($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $roles = Role::all();
        // dd($user);
        return view('hospital_panel.totalUsers.updateRole', ['user' => $user, 'roles' => $roles]);
    }

    public
    function updateUserRoleStore(Request $request)
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

    public
    function updateHospital()
    {
        try {
            $organization = \auth()->user()->user_organization->organization;
            $countries = Country::all();
            return view('hospital_panel.hospital.updateHospital', ['organization' => $organization, 'countries' => $countries,]);
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public
    function hospitalUpdated(Request $request)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,gif,svg,jpeg',
            'contactperson' => 'required|string',
            'phoneNumber' => 'required|string',
        ]);
        try {
            $org = Organization::where('uuid', $request->OrgUuid)->first();
            if ($request->hasFile('image')) {
                if (isset($org) && $org->image) {
                    $previous_img = public_path('uploads/organization/' . $org->image);
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                }
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = $org->image;
            }

            $org->update([
                'status' => $request->status,
                'image' => $image,
                'displayname' => $request->displayname,
                'contactperson_designation' => $request->contactperson_designation,
                'contactperson' => $request->phoneNumber,
                'email' => $request->email,
                'building' => $request->building,
                'district' => $request->district,
                'postalCode' => $request->postalCode
            ]);
            return redirect()->back()->withSuccess(__('Organization Successfully Updated'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public
    function updatePassword()
    {

        // dd(auth()->user(),session());
        // dd(session());
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return view('hospital_panel.profile.updatePassword');
    }

    public
    function passwordUpdated(Request $request)
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
        $userId = auth()->user()->id;
        // dd($userInfo);
        $token = $userInfo['sessionInfo']['token'];
        $data = ['currentpassword' => $request->currentpassword, 'newpassword' => $request->newpassword,];
        // dd($token);
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

            // dd($response,$password);
            if ($response == false) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $password->message]);
                }

                // dd(2);

                session_start();
                unset($userInfo);

                Session::flush();
                Auth::logout();

                if ($response == 'Success !! A password changed sucessfully') {
                    // dd(1);
                    curl_close($curl);
                    $user = User::where('id', $userId)->first();
                    $user->update(['password' => $request->newpassword]);
                    return redirect()->route('hospital.login')->withSuccess(__('Password Update Successfully'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => __($password->message)]);

                } else if (isset($password->message) && $password->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('hospital.login')->withErrors(['error' => __($password->message)]);
                } else if (isset($password->message) && $password->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $password->message]);
                } else if (isset($password->message) && $password->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $password->message]);
                } else {

                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $password->message]);
                }
            }
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->route('hospital.login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
