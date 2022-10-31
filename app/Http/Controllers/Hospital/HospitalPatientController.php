<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\UsersOrganization;
use App\Models\Organization;



class HospitalPatientController extends Controller
{
    public function patstoreHospitalPatientsient(Request $request)
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
                // dd($user);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $UserData=$request->all();
                    User::create([
                        'username' => $user->username,
                        'password' => $request->password,
                        'email' => $request->name,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'PersonId' => $user->personId,
                        'status' => 1

                    ]);
                
                    return $this->storePatients($user,$UserData);
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
    public function createHospitalPatients()
    {
        $users = User::all();
        return view('hospital_panel.patients.create', ['users' => $users]);
    }
    public function storePatients($user,$UserData)
    {

        // dd($UserData);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            'givenName' => $UserData['username'],
            'middleName' => $UserData['middlename'],
            'gender' => [
                'genderCode' => $UserData['gender_code'],
            ],
            'prefix' => '',
            'phoneExt' => '',
            'email' => $UserData['email'],
            'dateOfBirth' => $UserData['dateOfBirth'],
            'maritalStatus' => '',
        ];
        $params = array('userUuid' => $user->uuid);


        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/person?' . http_build_query($params),
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

                $patients = json_decode($response);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $user->uuid)->first();
                    curl_close($curl);
                    $user->update([
                        'PersonUuid' => $patients->PersonId,
                    ]);
                    return redirect()->back()->withSuccess(__('Patient Successfully Created'));
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

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
    public function mapPatients()
    {
        $users = User::whereNotNull('PersonUuid')->get();
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);
        return view('hospital_panel.patients.mapPatients', ['users' => $users, 'orgId' => $orgId]);
    }
    public function patientMapped(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        // dd($request->PersonId);
        $token = $userInfo['sessionInfo']['token'];
        $req_url = $baseUrl . 'rest/admin/orgPersonMapping/add/' . $request->user . '/' . $request->organisation;
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
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . $token,
                'apikey:' . $apiKey
            ),
        ));

        try {

            $response = curl_exec($curl);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                // dd($request->all());
                $patients = json_decode($response);


                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $users = User::where('PersonUuid', $request->user)->first();
                    $org = Organization::where('uuid', $request->organisation)->first();
                    Patient::firstOrCreate([
                        'user_id' => $users->id,
                        'organization_id' => $org->id,
                        'status' => 1,
                    ]);
                    UsersOrganization::firstOrCreate([

                        'status' => 1,
                        'registration_code' => '123ABC',
                        'user_id' => $users->id,
                        'organization_id' => $org->id
                    ]);

                    curl_close($curl);
                    return redirect()->back()->withSuccess(__('orgPersonMapping For orgID, Personid mapped successfully'));
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $patients->message]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

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
    public function hospitalAllPatients()
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('hospital.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        $token = $userInfo['sessionInfo']['token'];
        $orgId = $userInfo['sessionInfo']['orgId'];
        // dd($orgId);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/orgPersonMapping/persons/'.$orgId,
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
                    return view('hospital_panel.patients.index', ['all_patients' => $all_patients]);
                }

                else if (isset($all_patients->message) && $all_patients->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $all_patients->message]);
                }  else if (isset($all_patients->message) && $all_patients->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('hospital.login')->withErrors(['error' => $all_patients->message]);
                }
                  else if (isset($all_patients->message) && $all_patients->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->route('hospital.login')->withError(['error' => $all_patients->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' =>$all_patients->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withError(__($e->getMessage()));
            // return $e->getMessage();
        }
    }
}
