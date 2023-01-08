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
            if (!$user) {
                return redirect()->back()->withErrors('User does not Exist');
            }
            $password = Hash::check($request->password, $user->password);
            if (!$password) {
                return redirect()->back()->withErrors('Incorrect Password.');
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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $user = User::where('username', $request->username)->first();
            if (!$user) {
                return redirect()->back()->withErrors('User does not Exist');
            }
            // $password = $request->password;
           $password = Hash::check($request->password, $user->password);
            if ($password != $user->password) {
                return redirect()->back()->withErrors('Incorrect Password.');
            }
            Auth::login($user);
            session(['loggedInUser' => $user]);
            return redirect()->route('hospital.dashboard')->withSuccess('Successfully Login');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function hospitalDashboard()
    {
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
        
        // dd($user->doctor);
       
        if ($user) {

            if (!isset($user->doctor))
            return redirect()->back()->withErrors(['error' => 'User is not associated with any Department']);

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
