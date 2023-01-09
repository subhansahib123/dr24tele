<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentSpecializations;
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
    public function create($uuid)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        if ($containsHospital) {
            return view('hospital_panel.doctors.create', ['uuid' => $uuid]);
        }
        return view('admin_panel.doctors.create', ['uuid' => $uuid]);
    }

    public function store(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);

        $request->validate([
            'name' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
        ]);
        try {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=300,min_height=350',

                ]);
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/organization/department/doctor/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                if ($request->gender_code == 'F') {
                    $image = 'female-doctor.jpg';
                } else if ($request->gender_code == 'M') {
                    $image = 'male-doctor.webp';
                } else {
                    $image = 'doctor.jpg';
                }
            }
            if ($request->middlename) {
                $name = $request->name . ' ' . $request->middlename;
            } else {
                $name = $request->name;
            }

            User::create([
                'username' => '',
                'name' => $name,
                'image' => $image,
                'password' => '',
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonId' => Str::uuid(),
                'status' => 1
            ]);
            $user = User::where('phone_number', $request->phoneNumber)->first();
            $userUuid = $user->uuid;
            $depUuid = $request->uuid;
            return $this->mapDoctor($userUuid, $depUuid);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }

    public function mapDoctor($userUuid, $depUuid)
    {

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($departments);
        $specializations = DepartmentSpecializations::all();

        if ($containsHospital) {

            return view('hospital_panel.doctors.mapDoctor', ['depUuid' => $depUuid, 'userUuid' => $userUuid, 'specializations' => $specializations]);
        }
        $dep = Department::where('uuid', $depUuid)->first();
        $departments = Department::where('organization_id', $dep->organization_id)->get();
        return view('admin_panel.doctors.mapDoctor', ['departments' => $departments, 'userUuid' => $userUuid, 'specializations' => $specializations]);
    }

    public function doctorMapped(Request $request)
    {

        $url = url()->previous();
        $containsHospital = Str::contains($url, 'hospital');
        // dd($request->all());
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        try {
            $user = User::where('uuid', $request->user)->first();
            $department = Department::where('uuid', $request->department)->first();
            // dd($user,$department ,$organization);
            Doctor::create([
                'status' => 1,
                'user_id' => $user->id,
                'image' => '',
                'department_id' => $department->id,
                'prefix' => $request->prefix
            ]);
            $doctor = Doctor::where('user_id', $user->id)->first();
            $specializations = $request->specialization_id;
            $doctor->specialization()->sync($specializations);
            UsersOrganization::firstOrCreate([

                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $user->id,
                'organization_id' => $department->organization_id
            ]);
            User_Role::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => 4,
            ]);

            // dd($user->id,$role->id,$organization->id);


            if ($containsHospital) {
                return redirect()->route('hospitalDoctors.list', [$department->uuid])->withSuccess(__('Doctor is Successfully Created '));
            }
            return redirect()->route('doctors.list', [$department->uuid])->withSuccess(__('Doctor is Successfully Created '));
        } catch (\Exception $e) {
            if ($containsHospital) {
                return redirect()->route('create.doctor')->withErrors(['error' => __($e->getMessage())]);
            }
            return redirect()->route('createDoctor')->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
