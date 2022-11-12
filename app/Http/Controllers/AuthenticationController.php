<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;


class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('admin_panel.login');
    }
    public function login(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
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
        try {
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false || isset($response->status)) {
                curl_close($curl);
                return curl_error($curl);
            } else {
                $result_data = json_decode($response);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('username', $result_data->username)->first();

                    if ($user) {


                        Auth::login($user);
                        session(['loggedInUser' => $result_data]);
                        curl_close($curl);
                        return redirect()->route('dashboard')->withSuccess(__('Successfully Login'));
                    } else {
                        curl_close($curl);
                        return redirect()->back()->withErrors(['error' => 'No User Exist']);
                    }
                } else if (isset($result_data->message) && $result_data->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $result_data->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $result_data->message]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function logout(Request $request)
    {
        session_start();
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
            $logout = json_decode($response);

            try {
                //  dd($logout);
                if ($response == false) {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => $error]);
                } else {

                    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                        unset($userInfo);
                        Session::flush();
                        Auth::logout();
                        curl_close($curl);
                        // dd($userInfo);
                        $url = url()->previous();
                        $containsHospital = Str::contains($url, 'hospital');
                        $containsDoctor = Str::contains($url, 'doctor');

                        if ($containsHospital) {
                            return  redirect()->route('hospital.login');
                        } else if ($containsDoctor) {
                            return  redirect()->route('doctor.login');
                        } else {
                            return  redirect()->route('login.show');
                        }
                    } else if (isset($logout->message) && $logout->message == "API rate limit exceeded") {
                        curl_close($curl);
                        // dd($userInfo);
                        $url = url()->previous();
                        $containsHospital = Str::contains($url, 'hospital');
                        $containsDoctor = Str::contains($url, 'doctor');

                        if ($containsHospital) {
                            return  redirect()->route('hospital.login')->withErrors(['error' => $logout->message]);
                        } else if ($containsDoctor) {
                            return  redirect()->route('doctor.login')->withErrors(['error' => $logout->message]);
                        } else {
                            return  redirect()->route('login.show')->withErrors(['error' => $logout->message]);
                        }
                    } else if (isset($logout->message) && $logout->message == "Invalid Token") {

                        curl_close($curl);
                        // dd($userInfo);
                        $url = url()->previous();
                        $containsHospital = Str::contains($url, 'hospital');
                        $containsDoctor = Str::contains($url, 'doctor');

                        if ($containsHospital) {
                            return  redirect()->route('hospital.login')->withErrors(['error' => $logout->message]);
                        } else if ($containsDoctor) {
                            return  redirect()->route('doctor.login')->withErrors(['error' => $logout->message]);
                        } else {
                            return  redirect()->route('login.show')->withErrors(['error' => $logout->message]);
                        }
                    } else {
                        curl_close($curl);
                        return redirect()->back()->withErrors(['error' => $logout->message]);
                    }
                }
            } catch (\Exception $e) {
                // curl_close($curl);
                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
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
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
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

        // echo $response;
        try {
            if ($response == false) {
                curl_close($curl);

                return curl_error($curl);
            } else {
                $roles = json_decode($response);


                // dd($token);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    foreach ($roles as $role) {
                        Role::firstOrCreate([
                            'name' => $role->authority,
                            'slug' => Str::slug($role->authority)
                        ]);
                    }
                    return  view('admin_panel.user_role.show', ["roles" => $roles]);
                } else if (isset($roles->message) && $roles->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $roles->message]);
                } else if (isset($roles->message) && $roles->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $roles->message]);
                } else if (isset($roles->message) && $roles->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('login.show')->withErrors(['error' => $roles->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $roles->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function showHospitalLogin()
    {
    

        return view('hospital_panel.login');
    }

    public function hospitalLogin(Request $request)
    {
        // dd(1);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');


        $data = ['username' => $request->username, 'password' => $request->password];

        $user = User::with('user_organization')->where('username',  $request->username)->first();
        // dd  ($user->user_organization);
        if (!isset($user->user_organization))
            return redirect()->back()->withErrors(['error' => 'User is not associated with any Organisation']);
        $organisation = Organization::find($user->user_organization->organization_id);
        // dd  ($organisation->name);
        if (is_null($organisation))

            return redirect()->back()->withErrors(['error' => 'No Organisation record found in database']);

        if ($user) {


            Auth::login($user);



            $params = array('orgName' => $organisation->name, 'tenantId' => 'ehrn');
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
                // dd(1);
                $response = curl_exec($curl);

                // dd($response);
                if ($response == false || isset($response->status)) {
                    curl_close($curl);

                    return curl_error($curl);
                } else {
                    $result_data = json_decode($response);
                    // dd($result_data);
                    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {


                        curl_close($curl);

                        session_start();
                        session(['loggedInUser' => $result_data]);
                        $userInfo = session('loggedInUser');
                        $userInfo = json_decode(json_encode($userInfo), true);
                        // dd($userInfo);
                        return redirect()->route('hospital.dashboard')->withSuccess(__('Successfully Login'));
                    } else if (isset($result_data->message) && $result_data->message == "API rate limit exceeded") {
                        curl_close($curl);
                        return redirect()->route('hospital.login')->withErrors(['error' => $result_data->message]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid User") {

                        curl_close($curl);
                        return redirect()->route('hospital.login')->withErrors(['error' => $result_data->message]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid Token") {

                        curl_close($curl);
                        return redirect()->route('hospital.login')->withErrors(['error' => $result_data->message]);
                    } else {
                        curl_close($curl);
                        return redirect()->back()->withErrors(['error' => $result_data->message]);
                    }
                }
            } catch (\Exception $e) {


                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'No User Exist']);
        }
    }
    public function hospitalDashboard()
    {
        // dd(session('loggedInUser'));
        return view('hospital_panel.index');
    }
    public function ashboard()
    {
        return view('doctor_panel.dashboard');
    }

    public function showDoctorLogin()
    {
        return view('doctor_panel.login');
    }
    public function doctorLogin(Request $request)
    {
        // dd(1);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');




        $user = User::with('doctor')->where('phone_number',  $request->phoneNumber)->first();
        // dd($user); 
        if (!isset($user->doctor))
            return redirect()->back()->withErrors(['error' => 'User is not associated with any Department']);

        // dd($user->doctor->department);
        $organisation = $user->doctor->department;
        // dd  ($organisation->name);
        if (is_null($organisation))

            return redirect()->back()->withErrors(['error' => 'No Department record found in database']);

        if ($user) {


            Auth::login($user);

            $data = ['username' => $user->username, 'password' => $user->password];
            
            // dd($user->password);
            $params = array('orgName' => $organisation->slug, 'tenantId' => 'ehrn');
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
                // dd(1);
                $response = curl_exec($curl);

                // dd($response);
                if ($response == false || isset($response->status)) {
                    curl_close($curl);
                    dd(1);

                    return curl_error($curl);
                } else {
                    $result_data = json_decode($response);
                    // dd($result_data);
                    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {


                        curl_close($curl);

                        session_start();
                        session(['loggedInUser' => $result_data]);
                        $userInfo = session('loggedInUser');
                        $userInfo = json_decode(json_encode($userInfo), true);
                        // dd($userInfo);
                        return redirect()->route('doctor.dashboard')->withSuccess(__('Successfully Login'));
                    } else if (isset($result_data->message) && $result_data->message == "API rate limit exceeded") {
                        curl_close($curl);
                        return redirect()->route('doctor.show')->withErrors(['error' => $result_data->message]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid User") {

                        curl_close($curl);
                        return redirect()->route('doctor.show')->withErrors(['error' => $result_data->message]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid Token") {

                        curl_close($curl);
                        return redirect()->route('doctor.show')->withErrors(['error' => $result_data->message]);
                    } else {
                        curl_close($curl);
                        dd($result_data);
                        return redirect()->back()->withErrors(['error' => $result_data->message]);
                    }
                }
            } catch (\Exception $e) {

                dd(3);

                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'No User Exist']);
        }
    }
    public function DoctorDashboard()
    {
        
        return view('doctor_panel.dashboard');
    }
}
