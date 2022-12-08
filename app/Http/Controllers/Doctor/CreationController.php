<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Role;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreationController extends Controller
{
    public function create()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital) {
            return view('hospital_panel.doctors.create');
        }
        return view('admin_panel.doctors.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'image' => 'required',
        ]);
        try {
            if ($request->hasFile('image')) {
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/doctor/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = '';
            }


            User::create([
                'username' => $request->username,
                'name' => $request->name . ' ' . $request->middlename,
                'image' => $image,
                'password' => $request->password,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonId' => Str::uuid(),
                'status' => 1
            ]);
            $user = User::where('username', $request->username)->first();
            $userUuid = $user->uuid;
            return $this->mapDoctor($userUuid);


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function mapDoctor($userUuid)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $organizations = Organization::all();
        // dd($departments);

        if ($containsHospital) {

            $organization = \auth()->user()->user_organization->organization;
            $departments = Department::where('organization_id', $organization->id)->get();
            return view('hospital_panel.doctors.mapDoctor', ['organization' => $organization, 'departments' => $departments, 'userUuid' => $userUuid]);
        }
        return view('admin_panel.doctors.mapDoctor', ['organizations' => $organizations, 'userUuid' => $userUuid]);
    }

    public function doctorMapped(Request $request)
    {

        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        // dd($request->all());
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $orgUuid = $request->organization;
        try {
            $user = User::where('uuid', $request->user)->first();
            $department = Department::where('uuid', $request->department)->first();
            $organization = Organization::where('uuid', $orgUuid)->first();
            // dd($user,$department ,$organization);
            Doctor::create([
                'status' => 1,
                'user_id' => $user->id,
                'image' => '',
                'department_id' => $department->id,

            ]);
            UsersOrganization::firstOrCreate([

                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $user->id,
                'organization_id' => $organization->id
            ]);
            User_Role::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => 4,
            ]);

            // dd($user->id,$role->id,$organization->id);


            if ($containsHospital) {
                return redirect()->route('hospitalDoctors.list',[$department->uuid])->withSuccess(__('Doctor is Successfully Created '));
            }
            return redirect()->route('doctors.list',[$department->uuid])->withSuccess(__('Doctor is Successfully Created '));


        } catch (\Exception $e) {
            if ($containsHospital) {
                return redirect()->route('create.doctor')->withErrors(['error' => __($e->getMessage())]);
            }
            return redirect()->route('createDoctor')->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
