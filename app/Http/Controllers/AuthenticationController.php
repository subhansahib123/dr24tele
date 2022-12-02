<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('admin_panel.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $user = User::where('username', $request->username)->first();
            $password = Hash::check($request->password, $user->password);
            if (!$password) {
                return redirect("admin/login")->withErrors('Could not log you in, please recheck your password.');
            }
            Auth::login($user);
            session(['loggedInUser' => $user]);
            return redirect()->intended('admin/dashboard')->withSuccess('Successfully Login');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
    public function dashboard()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        return view('admin_panel.index');
    }
    public function roles(Request $request)
    {

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {
            return redirect()->route('login.show')->withErrors(['error' => 'Login Expired Please Login Again !']);
        }

        try {
            if ($userInfo) {

                $roles = Role::all();

                // dd($roles);

                return  view('admin_panel.user_role.show', ["roles" => $roles]);
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
        // dd($request->all());
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

        $user = User::with('doctor')->where('phone_number',  $request->phoneNumber)->first();
        // dd($user);
        if (!isset($user->doctor))
            return redirect()->back()->withErrors(['error' => 'User is not associated with any Department']);

        // dd($user->doctor);
        $organisation = $user->doctor->department;
        // dd  ($organisation->name);
        if (is_null($organisation))

            return redirect()->back()->withErrors(['error' => 'No Department record found in database']);

        if ($user) {


            Auth::login($user);

            try {
                // dd(1);

                session_start();
                session(['loggedInUser' => $user]);
                return redirect()->route('doctor.dashboard')->withSuccess(__('Successfully Login'));
            } catch (\Exception $e) {

                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'No User Exist']);
        }
    }
    public function DoctorDashboard()
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        return view('doctor_panel.dashboard');
    }
}
