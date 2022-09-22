<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Str;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo))
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        $apiKey = config('services.ehr.apiKey');


        $data = ['username' => $request->username, 'password' => $request->password];
        $params = array('orgName' => 'dr-tele', 'tenantId' => 'ehrn');
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
        // dd($curl);
        try {
            $response = curl_exec($curl);

            if ($response == false || isset($response->status)) {
                return curl_error($curl);
            } else {
                $result_data = json_decode($response);
              
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200 ) {
                    $user = User::where('username', $result_data->username)->first();
                    curl_close($curl);
                    if($user){
                        
                    
                    Auth::login($user);
                    session(['loggedInUser' => $result_data]);
                    return redirect()->route('dashboard')->withSuccess(__('Successfully Login'));
                    }else {
                        return redirect()->back()->withErrors(['error' => 'No User Exist']);
                    }
                    

                    
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Failed to serialize to JSON']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'User / login blocked; return login failure with delay']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'User does not exist in DB']);
                } else if (isset($result_data->message) && $result_data->message = "API rate limit exceeded") {
                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($result_data->message) && $result_data->message = "Invalid Token") {
                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    return redirect()->back()->withErrors(['error' => __('Unknow Error From Api.')]);
                }
            }
            curl_close($curl);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function logout(Request $request)
    {
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        if (!empty($userInfo)) {
            $userInfo = json_decode(json_encode($userInfo), true);
            $token = $userInfo['sessionInfo']['token'];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseUrl . 'rest/admin/logout',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization:' . $token,
                    'apikey:' . $apiKey
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            try {
                if ($response == false) {
                    return curl_error($curl);
                } else {
                    return  redirect(route('login.show'));
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
    public function dashboard()
    {
        // dd(session('loggedInUser'));
        return view('admin_panel.index');
    }
    public function roles(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $data = ['username' => $request->username, 'password' => $request->password];
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);

        $token = $userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/role?order=ASC',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: ' . $token,
                'apikey:' . $apiKey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        try {
            if ($response == false) {
                return curl_error($curl);
            } else {
                $roles = json_decode($response);
                // dd($token);

                foreach ($roles as $role) {
                    Role::firstOrCreate([
                        'name' => $role->authority,
                        'slug' => Str::slug($role->authority)
                    ]);
                }
                // dd($roles);
                return  view('admin_panel.user_role.show', ["roles" => $roles]);
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
