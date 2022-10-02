<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\UsersOrganization;

class PatientController extends Controller
{
    public function createPatients()
    {
        $users = User::all();
        return view('admin_panel.patients.create', ['users' => $users]);
    }
    public function storePatients(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)){
            \Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            'givenName' => $request->givenName,
            'middleName' => $request->middleName,
            'gender' => [
                'genderCode' => $request->genderCode,
            ],
            'prefix' => $request->prefix,
            'phoneExt' => $request->phoneExt,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'maritalStatus' => $request->maritalStatus,
        ];
        $params = array('userUuid' => $request->userUuid);


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
                    $user = User::where('uuid', $request->userUuid)->first();
                    curl_close($curl);
                    $user->update([
                        'PersonId' => $patients->PersonId,
                    ]);
                    return redirect()->back()->withSuccess(__('Patient Successfully Created'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not authorized to create person or EHR for person']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'invalid useruuid / Please provide userUuid']);
                } else if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($patients->message) && $patients->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    curl_close($curl);


                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function mapPatients()
    {
        $users = User::whereNotNull('PersonId')->get();
        $organizations = Organization::all();
        return view('admin_panel.patients.mapPatients', ['users' => $users, 'organizations' => $organizations]);
    }
    public function patientMapped(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)){
            \Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        // dd($request->PersonId);
        $token = $userInfo['sessionInfo']['token'];
        $params = array('personUuid' => $request->PersonId, 'orgUuid' => $request->uuid);
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
                    $users = User::where('PersonId', $request->user)->first();
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
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not authorized to create person or EHR for person']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Please provide valid orgUUID to addOrgPersonMappingByOrgId / Please provide valid personUUID to addOrgPersonMappingByOrgId ']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Person doesnt exists in DB / person already mapped to the organization']);
                } else if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($patients->message) && $patients->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    curl_close($curl);


                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function patientsList($uuid)
    {
        // dd(1);

        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/orgPersonMapping/persons/' . $uuid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token,
                'apikey: ' . $apiKey
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

                // dd($patients);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    // dd($patients);
                    return view('admin_panel.patients.showPatients', ['patients' => $patients]);
                } else if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($patients->message) && $patients->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {

                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function patientDelete($uuid)
    {

        
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/person/'.$uuid.'?reason=duplicate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: ' . $token,
                'apikey: ' . $apiKey
            ),
        ));
        try {

            $response = curl_exec($curl);

            dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                // dd($request->all());
                $patients = json_decode($response);
                // dd($patients);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $user= User::where('PersonId',$uuid)->first();
                    if($user){
                        UsersOrganization::where('user_id',$user->id)->delete();
                        Patient::where('user_id',$user->id)->delete();
                        $user->delete();
                    }
                    return redirect()->back()->withSuccess(__('Successfully Patient Deleted'));
                } 
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400){
                    return redirect()->back()->withErrors(['error' => __($patients->message)]);

            } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {

                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function   updatePatient($personId)
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
        $req_url=$baseUrl.'rest/admin/person/'.$personId;
        // dd($req_url);

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
              'Authorization:'.$token,
              'apikey:'.$apiKey
            ),
          ));
          
        try {
            $response = curl_exec($curl);
            dd($response);

            if ($response == false) {

                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $user = json_decode($response);
                $userName=User::where('personId',$user->personId)->first();
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    if(isset($userName)){
                        return view('admin_panel.patients.updatePatient', ['user' => $user,'userName'=>$userName]);
                    }
                    else{
                        $userapi=$this->getUserFromPersonId($user->personId);
                        $user=User::create();
                        Patient::create();
                        return redirect()->back()->withErrors(['error' => 'Patient Do not exist in Your database']);
                    }
                    
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $user->message]);
                }else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $user->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $user->message]);
                }
            }
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
    protected function getUserFromPersonId($personId){
        //request 
        //response
        return $response;
    }
    
    public function   patientUpdated(Request $request)
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
        $req_url=$baseUrl.'rest/admin/person/'.$request->personId;
        
        $data = [
            'givenName' => $request->givenName,
            'middleName' => $request->middleName,
            'gender' => [
                'genderCode' => $request->genderCode,
            ],
            'prefix' => $request->prefix,
            'phoneExt' => $request->phoneExt,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'maritalStatus' => $request->maritalStatus,
        ];
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
            CURLOPT_POSTFIELDS =>json_encode($data),
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Accept: application/json',
              'Authorization:'.$token,
              'apikey: '.$apiKey
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
                $patient = json_decode($response);
                // dd($userName->username);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $user=User::where('personId',$request->personId)->first();
                    if (isset($user)&&count($user)>0){
                        User::create([
                            'username' => $user->username,
                            'password' => \Hash::make($request->password),
                            'email' => $request->email,
                            'phone_number' => $request->phoneNumber,
                            'uuid' => $user->uuid,
                            'status' => 1
    
                        ]);
                    }else{
                    $user->update([
                        'email'=>$request->email,
                        'password'=>\Hash::make($request->password),
                        'phone_number'=>$request->phoneNumber,
                    ]);
                }
                    return redirect()->back()->withSuccess(__('Patient Successfully Updated'));
                
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $patient->message]);
                }else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $patient->message]);
                } else {
                    curl_close($curl);


                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $patient->message]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }
}
