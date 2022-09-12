<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function showLogin(){
        return view('login');
    }
    public function login(Request $request){
        $curl = curl_init();
        $baseUrl=config('services.ehr.baseUrl');
        $apiKey=config('services.ehr.apiKey');


        $data=['username'=>$request->username,'password'=>$request->password];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl.'rest/admin/v1/login?orgName=dr-tele&tenantId=ehrn',
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
                    'apikey: '.$apiKey
                ),
        ));
        try{
            $response = curl_exec($curl);
            curl_close($curl);
            if($response==false){
                return curl_error($curl);
            }else {
                $result_data=json_decode($response);
                $user=User::where('username',$result_data->username)->first();
                if($user){
                    Auth::login($user);
                    session(['loggedInUser' => $result_data]);
                    return view('admin_panel.index');
                }
                else {
                    return response('signup');
                }

            }


        }
        catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function dashboard(){
        return view('admin_panel.index');
    }
}
