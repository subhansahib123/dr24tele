<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Models\Role;

class UserController extends Controller
{
    public function patient()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
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
            curl_close($curl);
            if ($response == false) {
                $error = curl_error($curl);
                return redirect()->view('admin_panel.patient.show')->withError(__($error));
            } else {
                $patients = json_decode($response);
                // dd($patients);
                if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    return view('admin_panel.patient.show')->withError(__('API rate limit exceeded.'));
                } else if (isset($patients->message) && $patients->message = "Invalid Token") {
                    return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
                } else {
                    return view('admin_panel.patient.show', ['patients' => $patients]);
                }
            }
        } catch (\Exception $e) {

            // return $e->getMessage();
            return redirect()->view('admin_panel.patient.show')->withError(__($e->getMessage()));
        }
    }
    public function all_patient()
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
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

            curl_close($curl);
            if ($response == false) {
                $error = curl_error($curl);
                // return $error;
                return redirect()->back()->withError(__($error));
            } else {
                $all_patients = json_decode($response);
                if (isset($all_patients->message) && $all_patients->message = "API rate limit exceeded") {
                    return redirect()->back()->withError(__('API rate limit exceeded.'));
                } else if (isset($all_patients->message) && $all_patients->message = "Invalid Token") {
                    return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
                } else {
                    return view('admin_panel.all_patients.show', ['all_patients' => $all_patients]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError(__($e->getMessage()));
            // return $e->getMessage();
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

            curl_close($curl);

            if ($response == false) {
                $error = curl_error($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $user = json_decode($response);
                // dd($users);
                if ($user) {
                    User::create([
                        'username' => $user->username,
                        'password' => \Hash::make($request->password),
                        'email' => $user->username,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'status' => 1

                    ]);
                    return redirect()->back()->withSuccess(__('Successfully Created User'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function mapUser()
    {
        $users = User::all();
        $roles = Role::all();
        // dd($roles);
        return view('admin_panel.mapping_user.index', ['users' => $users, 'roles' => $roles]);
    }



    public function mapUserRole(Request $request)
    {

        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/orgUserMapping/role/add/c6bc6265-e876-414a-9672-a85e09280059',
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
                // dd($error);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $userRole = json_decode($response);
                // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    return redirect()->back()->withSuccess(__('Successfully Mapped User Role'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    return redirect()->back()->withErrors(['error' => 'User role already exists']);
                } else {
                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $userRole->message]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    public function updateUserRole()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin_panel.mapping_user.update', ['users' => $users, 'roles' => $roles]);
    }
    public function updateUserRoleStore(Request $request)
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $token = $userInfo['sessionInfo']['token'];
        $data = [['useruuid' => $request->user, 'rolename' => $request->role]];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl.'/rest/admin/orgUserMapping/role/update/c6bc6265-e876-414a-9672-a85e09280059',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => '[
          {
            "useruuid": "7655e896-08f5-45cb-9749-c06e764d71eb",
            "rolename": "Practitioner"
          }
        ]',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: '.$token,
                'apikey: '.$apiKey,
            ),
        ));

        try {
            $response = curl_exec($curl);

            if ($response == false) {
                $error = curl_error($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $UpdatedRole = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    return redirect()->back()->withSuccess(__('Successfully User Role Updated'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    return redirect()->back()->withErrors(['error' => 'User role already exists']);
                } else {
                    dd($UpdatedRole);
                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    
}
