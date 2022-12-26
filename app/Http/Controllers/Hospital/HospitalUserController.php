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

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
        $users = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query) use ($orgId) {
            $query->where('organization_id', $orgId);
        })->get();

        return view('hospital_panel.totalUsers.index', ['users' => $users]);
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
            $patients = User::whereDoesntHave('doctor')->whereDoesntHave('patient')->whereHas('user_organization', function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
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
                'status' => 1,
                'image' => $image,

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
            return redirect()->route('allHospital.users')->withSuccess(__('Successfully User Created'));
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
                if ($user->doctor)
                    Doctor::where('user_id', $user->id)->delete();
                $user->delete();
            }
            return redirect()->back()->withSuccess(__('Doctor Successfully Deleted '));
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
        if(isset($request->image)){
            $request->validate([
                'image' => 'nullable|image|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=1140,min_height=650',
            ]);
        }
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
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'currentPassword' => 'required'
        ]);
        // dd(auth()->user()->id);
        $userId = auth()->user()->id;

        if (is_null($userId)) {
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {
            $user = User::where('id', $userId)->first();
            if ($user->password == $request->currentPassword) {
                // dd(1);
                session_start();
                unset($userInfo);

                Session::flush();
                Auth::logout();

                $user->update(['password' => $request->password]);
                return redirect()->route('hospital.login')->withSuccess(__('Password Update Successfully'));
            }
            // dd(2);
            return redirect()->back()->withErrors(['error' => 'Your Current Password is not Correct']);
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
