<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreationController extends Controller
{
    public function create()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital) {
            return view('hospital_panel.doctors.create');
        }
        return view('admin_panel.doctors.create');
    }
    public function store(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        // dd($request->all());
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');


        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
        ]);
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
            // dd($user);

            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $user = json_decode($response);
                // dd($user->name);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    // dd(1);

                    User::create([
                        'username' => $user->username,
                        'name' => $user->name,
                        'password' => $request->password,
                        'email' => $request->email,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'PersonId' => $user->personId,
                        'status' => 1

                    ]);
                    $user = User::where('username', $user->username)->first();
                    // dd($user)
                    $userUuid=$user->uuid;
                    return $this->mapDoctor($userUuid);
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
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function mapDoctor($userUuid)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $orgId=$userInfo['sessionInfo']['orgId'];
        $organization = Organization::where('uuid',$orgId)->first();
        $departments=Department::where('organization_id',$organization->id)->get();
        // dd($departments);

        if ($containsHospital) {
            return view('hospital_panel.doctors.mapDoctor', ['organization' => $organization,'departments'=>$departments,'userUuid'=>$userUuid]);
        }
        return view('admin_panel.doctors.mapDoctor', ['organization' => $organization,'departments'=>$departments,'userUuid'=>$userUuid]);
    }
    public function doctorMapped(Request $request)
    {
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        // dd($request->all());
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $curl = curl_init();
        $uuid = '';
            $uuid = $request->department;
        $orgUuid = $request->organization;
        // dd($uuid);
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        

        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => 'practitioner']];
        $req_url = $baseUrl . '/rest/admin/orgUserMapping/role/add/' . $uuid;
        // dd($request->all());
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


            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                if($containsHospital){
                    return redirect()->route('create.doctor')->withErrors(['error' => $error]);
                    }
                    return redirect()->route('createDoctor')->withErrors(['error' => $error]);
            
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd($userRole);

                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $userRole[0]->useruuid)->first();
                    $role = Role::where('name', $userRole[0]->rolename)->first();
                    $department = Department::where('uuid', $request->department)->first();
                    $organization = Organization::where('uuid', $request->organization)->first();
                    // dd($user->id,$department->id, $role->id, $organization->id);
                    curl_close($curl);
                    // dd($containsHospital);

                    Doctor::create([
                        'status'=>1,
                        'user_id'=>$user->id,
                        'department_id'=>$department->id,
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

                    // dd($user->id,$role->id,$organization->id);



                    if($containsHospital){
                    return redirect()->route('create.doctor')->withSuccess(__('Doctor is Successfully Created '));
                    }
                    return redirect()->route('createDoctor')->withSuccess(__('Doctor is Successfully Created '));
                }  else if (isset($userRole->message) && $userRole->message == "API rate limit exceeded") {
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

                    if($containsHospital){
                        return redirect()->route('create.doctor')->withErrors(['error' => $userRole->message]);
                        }
                        return redirect()->route('createDoctor')->withErrors(['error' => $userRole->message]);
                }
            }
        } catch (\Exception $e) {
            if($containsHospital){
                return redirect()->route('create.doctor')->withErrors(['error' => __($e->getMessage())]);
                }
                return redirect()->route('createDoctor')->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
