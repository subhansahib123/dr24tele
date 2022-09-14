<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

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
                if(isset($patients->message) && $patients->message="API rate limit exceeded"){
                    return view('admin_panel.patient.show')->withError(__('API rate limit exceeded.'));
                }else if(isset($patients->message) && $patients->message="Invalid Token"){
                    return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
                }else{
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
                if(isset($all_patients->message) && $all_patients->message="API rate limit exceeded"){
                    return redirect()->back()->withError(__('API rate limit exceeded.'));
                }else if(isset($all_patients->message) && $all_patients->message="Invalid Token"){
                    return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
                }else{
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
        $baseUrl=config('services.ehr.baseUrl');
        $apiKey=config('services.ehr.apiKey');

        $data=['user'=>[
            'username'=>$request->username,
            'password'=>$request->password
        ],
        'person'=>[
            'givenName'=>$request->name,
            'middleName'=>$request->middlename,
            'email'=>$request->email,
            'gender'=>[
                'genderCode'=>$request->gender_code,
            ],
            'phoneNumber'=>$request->phoneNumber,
            'dateOfBirth'=>$request->dateOfBirth,

            ]
        ];
        // dd($data);
        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo), true);

        $token=$userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => $baseUrl.'/rest/admin/user',
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
            'Authorization: '.$token,
            'apikey:'.$apiKey
          ),
        ));
        $response = curl_exec($curl);

            curl_close($curl);
        // try {
            
        //     if ($response == false) {
        //         $error = curl_error($curl);
        //         // return $error;
        //         return redirect()->back()->withError(__($error));
        //     } else {
        //         $user = json_decode($response);

        //         if(isset($all_patients->message) && $all_patients->message="API rate limit exceeded"){
        //             return redirect()->back()->withError(__('API rate limit exceeded.'));
        //         }else if(isset($all_patients->message) && $all_patients->message="Invalid Token"){
        //             return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
        //         }else{
        //         return view('admin_panel.all_patients.show', ['all_patients' => $all_patients]);
        //         }
                
        //     }
        // } catch (\Exception $e) {
        //     return redirect()->back()->withError(__($e->getMessage()));
        //     // return $e->getMessage();
        // }
        
           
    }
}
