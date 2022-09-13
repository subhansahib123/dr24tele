<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Str;
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
        $params = array('orgName' => 'dr-tele','tenantId'=>'ehrn');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl.'rest/admin/v1/login?'.http_build_query($params),
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
        // dd($curl);
        try{
            $response = curl_exec($curl);
            curl_close($curl);
            if($response==false || isset($response->status)){
                return curl_error($curl);
            }else {
                $result_data=json_decode($response);

                // dd($result_data);
                $user=User::where('username',$result_data->username)->first();
                if($user){
                    Auth::login($user);
                    session(['loggedInUser' => $result_data]);
                    return redirect()->route('dashboard');
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
        // dd(session('loggedInUser'));
        return view('admin_panel.index');
    }
    public function roles(Request $request)
    {
        $curl = curl_init();
        $baseUrl=config('services.ehr.baseUrl');
        $apiKey=config('services.ehr.apiKey');

        $data=['username'=>$request->username,'password'=>$request->password];
        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo), true);
        
        $token=$userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => $baseUrl.'rest/admin/role?order=ASC',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: '.$token,
            'apikey:'.$apiKey
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        try{
            if($response==false){
                return curl_error($curl);
            }else {
                $roles=json_decode($response);

                foreach($roles as $role){
                    Role::firstOrCreate([
                        'name'=>$role->authority,
                        'slug'=>Str::slug($role->authority)
                    ]);
                }

                return  view('admin_panel.user_role.show',["roles"=>$roles]);
                dd($roles);
            }
        }
        catch (\Exception $e) {

            return $e->getMessage();


    }
}
}
