<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\UsersOrganization;
use App\Models\Appointment;
use App\AgoraToken\Src\RtcTokenBuilder;
use Session;

class PatientAuthenticationController extends Controller
{
    public function appointments(){
        $patient_id=auth()->user()->patient->id;
        // dd(Auth::user()->patient->id);
        $appointements=Appointment::where('patient_id', $patient_id)->get();
        return view('patient_panel.appointement.index',compact('appointements'));
    }
    public function conference_call(Request $request){
       $channelname= $request->channelName;
       $token= $request->token;
        return view('conference',compact('channelname','token'));
    }


     public function generate_token(Request $request)
    {


            $appID = "e4fc13e59b1d4105b5dd434a56a2bf94";
            $appCertificate = "46369135cce54217935851efd0844afb";
            $channelName = $request->channel;
            $uid = (int) mt_rand(1000000000, 9999999999);
            $uidStr = strval($uid);
            $role = RtcTokenBuilder::RoleAttendee;
            $expireTimeInSeconds = 2400;
            $currentTimestamp = (new \DateTime("now", new \DateTimeZone('Asia/Karachi')))->getTimestamp();
            $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

            $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, null, $role, $privilegeExpiredTs);



            $obj = ["token" => $token];

            return response()->json($obj);

    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('patient.login')->withSucess(__('Successfully logged out!'));
    }
    public function patientDashboard(){
        return view('patient_panel.dashboard');
    }
    public function login(){
        return view('patient_panel.login');
    }
    public function performLogin(Request $request)
    {
        // dd($request->all());
        $user = User::where('phone_number',  $request->phoneNumber)->first();

        
        if ($user) {


            Auth::login($user);
            // dd(Auth::user());
            return redirect()->route('patient.dashboard')->withSuccess(__('Successfully Login'));


        } else {
            return redirect()->back()->withErrors(['error' => 'No User Exist']);
        }
    }


    public function register(){
        $organizations=Organization::all();
        return view('patient_panel.register',compact('organizations'));
    }
    protected function adminLogin($orguuid){

        // dd(1);
        // session(['ApiUserAction' => null]);
         $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $organisation=Organization::where('uuid',$orguuid)->first();
        // dd($organisation);
        $user=UsersOrganization::with(['user'=>function($q){
            $q->with(['user_role'=>function($qu){
                $qu->where('role_id',1);
            }]);
        }])->where('organization_id',$organisation->id)->first();
        dd($user);
        $data = ['username' => $user->user->username, 'password' => $user->user->password];

        $params = array('orgName' =>  $organisation->name, 'tenantId' => 'ehrn');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/v1/login?' . http_build_query($params),
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
                'apikey: ' . $apiKey
            ),
        ));
        try {
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false || isset($response->status)) {
                curl_close($curl);
                return curl_error($curl);
            } else {
                $result_data = json_decode($response);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {




                    session(['ApiUserAction' => $result_data]);
                    curl_close($curl);
                    return true;

                } else if (isset($result_data->message) && $result_data->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return ['error' => $result_data->message];
                } else {
                    curl_close($curl);
                    return ['error' => $result_data->message];
                }
            }
        } catch (\Exception $e) {

            return ['error' => __($e->getMessage())];
        }
    }
    public function store_user(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'givenName' => 'required|string',
            'email' => 'required',
            'gender_code' => 'required|string',
            'phoneNumber' => 'required|string',
            'dateOfBirth'=>'required'
        ]);
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
                // 'middleName' => $request->middlename,
                'email' => $request->email,
                'gender' => [
                    'genderCode' => $request->gender_code,
                ],
                'phoneNumber' => $request->phoneNumber,
                'dateOfBirth' => $request->dateOfBirth,

            ]
        ];
        $orguuid=$request->orguuid;

        // $this->adminLogin($orguuid);
        $adminUserInfo = session('ApiUserAction');
        $adminUserInfo = json_decode(json_encode($adminUserInfo), true);
        // dd(session());
        if ($adminUserInfo==null) {
            $this->adminLogin($orguuid);
            $adminUserInfo = session('ApiUserAction');
            dd($adminUserInfo );
            $adminUserInfo = json_decode(json_encode($adminUserInfo), true);

        }
        // dd($adminUserInfo);
        $token = $adminUserInfo['sessionInfo']['token'];
        dd(2);

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
        dd(1);

        try {
            $response = curl_exec($curl);


            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                return ['error' => $error];
            } else {
                $user = json_decode($response);
                dd($user);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    //create patient here
                   $personId=$this->storePatients($request,$user->uuid);

                   if(is_array($personId) && isset($personId['error'])){
                        return redirect()->back()->withErrors($personId);
                   }

                    $user=User::create([
                        'username' => $user->username,
                        'name' => $request->givenName,
                        'password' => $request->password,
                        'email' => $request->email,
                        'phone_number' => $request->phoneNumber,
                        'uuid' => $user->uuid,
                        'PersonId'=>$personId,
                        'status' => 1

                    ]);

                    $mapPatient=$this->patientMapped($personId,$orguuid);

                    if(is_array($mapPatient) && isset($mapPatient['error'])){
                        return redirect()->back()->withErrors($mapPatient);
                   }
                //     $getPatientAuth=$this->getPatientAuth($request,$personId);

                //     // dd($getPatientAuth);
                //     if(is_array($getPatientAuth) && isset($getPatientAuth['error'])){
                //         return redirect()->back()->withErrors($getPatientAuth);
                //    }
                    return redirect()->back()->withSuccess(__('Successfully Registered Now you can Login'));
                } else if (isset($user->message) && $user->message == "API rate limit exceeded") {
                    curl_close($curl);

                    return  redirect()->back()->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $user->message]);
                } else if (isset($user->message) && $user->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $user->message]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $user->message]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    protected function storePatients($request,$uuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('ApiUserAction');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            $this->adminLogin();
            $userInfo = session('ApiUserAction');
            $userInfo = json_decode(json_encode($userInfo), true);
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
        $params = array('userUuid' => $uuid);


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
                return ['error' => __($error)];
            } else {

                $patients = json_decode($response);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $request->userUuid)->first();
                    curl_close($curl);

                    return $patients->PersonId;
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return ['error' => $patients->message];
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return ['error' => $patients->message];
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

                    curl_close($curl);
                    return ['error' => $patients->message];
                } else {
                    curl_close($curl);
                    return ['error' => $patients->message];
                }
            }
        } catch (\Exception $e) {


            return ['error' => __($e->getMessage())];
        }
    }
    protected function patientMapped($personId,$orgUuid)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('ApiUserAction');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

             $this->adminLogin();
            $userInfo = session('ApiUserAction');
            $userInfo = json_decode(json_encode($userInfo), true);
        }
        // dd($request->PersonId);
        $token = $userInfo['sessionInfo']['token'];

        $req_url = $baseUrl . 'rest/admin/orgPersonMapping/add/' . $personId . '/' . $orgUuid;

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

                return ['error' => __($error)];;
            } else {
                // dd($request->all());
                $patients = json_decode($response);


                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $users = User::where('PersonId', $personId)->first();
                    $org = Organization::where('uuid', $orgUuid)->first();
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
                    return true;
                } else if (isset($patients->message) && $patients->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return ['error' => $patients->message];
                } else if (isset($patients->message) && $patients->message == "Invalid User") {

                    curl_close($curl);
                    return ['error' => $patients->message];
                } else if (isset($patients->message) && $patients->message == "Invalid Token") {

                    curl_close($curl);
                    return ['error' => $patients->message];
                } else {
                    curl_close($curl);
                    return ['error' => $patients->message];
                }
            }
        } catch (\Exception $e) {


            return ['error' => __($e->getMessage())];
        }
    }
    //plan with appointment service
    protected function getPatientAuth($request ,$personId){

          $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('ApiUserAction');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

             $this->adminLogin();
            $userInfo = session('ApiUserAction');
            $userInfo = json_decode(json_encode($userInfo), true);
        }

        $token = $userInfo['sessionInfo']['token'];
        // dd($baseUrl);
        $data=[
            'user'=>['username'=>$request->username,'password'=>$request->password],

            'person'=>['personId'=>$personId,'givenName'=>$request->givenName]
        ];
        // dd($data);
        $req_url = $baseUrl .'rest/admin/user?role=person';
        // $params=array('role'=>'person'); .http_build_query($params)

        curl_setopt_array($curl, array(
            CURLOPT_URL =>$req_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token,
                'apikey: '.$apiKey,
                'Content-Type: application/json'
            ),
        ));
        try{




        $response = curl_exec($curl);
        // dd($response);
        if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);
                // dd($error);
                return ['error' => __($error)];;
            } else {
                // dd($request->all());
                $patient = json_decode($response);


                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {


                    curl_close($curl);
                    return true;
                } else if (isset($patient->message) && $patient->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return ['error' => $patient->message];
                } else if (isset($patient->message) && $patient->message == "Invalid User") {

                    curl_close($curl);
                    return ['error' => $patient->message];
                } else if (isset($patient->message) && $patient->message == "Invalid Token") {

                    curl_close($curl);
                    return ['error' => $patient->message];
                } else {
                    curl_close($curl);
                    return ['error' => $patient->message];
                }
            }
        }
        catch(\Exception $e){
            return ['error' => __($e->getMessage())];
        }


    }
}
