<?php

namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Department;
use App\Models\DepartmentSpecializations;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Organization;
use App\Models\State;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request){
        $organizations = Organization::has('department')->orderBy('id', 'desc')->paginate(6);
        if ($request->ajax()) {
            $search = $request->get('query');
            $organizations = Organization::has('department')->orderBy('id', 'desc')->where(function ($q) use ($search) {
                if (!empty($search)) {
                    $q->where('name', 'like', '%' . $search . '%');
                }
            })->paginate(6);
        }
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "organizations"=>$organizations,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Organizations',
            ]
        ]);
    }
    //Hospital Details
    public function hospitalDetails($id)
    {
        // \DB::enableQueryLog(); // Enable query log
        $hospital = Organization::has('department')->where('id', $id)->first();
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
        $doctorSpecializations = DoctorSpecialization::has('specializedDoctor')->get();


        // $departments=Department::has('doctor')->orderBy('id','desc')->paginate(6);
        // dd(\DB::getQueryLog()); // Show results of log
        $state = State::where('id', $hospital->state)->first();
        $city = City::where('id', $hospital->city)->first();
        $stateName = $state->name;
        $cityName = $city->name;
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "hospital"=>$hospital,
                "stateName"=>$stateName,
                "cityName"=>$cityName,
                "departmentSpecializations"=>$departmentSpecializations,
                "doctorSpecializations"=>$doctorSpecializations,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Hospital',
            ]
        ]);
    }
    //Department Details
    public function departmentDetails($id)
    {
        $department = Department::where('id', $id)->first();
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
        $doctorSpecializations = DoctorSpecialization::has('specializedDoctor')->get();
        $doctors = Doctor::with('user', 'specializedDoctor')->where('department_id', $id)->get();
        // dd( $department,$doctors);y
        $state = State::where('id', $department->organization->state)->first();
        $city = City::where('id', $department->organization->city)->first();
        $stateName = $state->name;
        $cityName = $city->name;
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "department"=>$department,
                "doctors"=>$doctors,
                "departmentSpecializations"=>$departmentSpecializations,
                "doctorSpecializations"=>$doctorSpecializations,
                "stateName"=>$stateName,
                "cityName"=>$cityName,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Department',
            ]
        ]);
    }
    //Doctor Specializations
    public function allDoctors($id)
    {
        $doctors = DoctorSpecialization::where('id', $id)->first();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "doctors"=>$doctors,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Doctors',
            ]
        ]);
    }
    //Department Specializations
    public function departmentSpecializations(Request $request)
    {
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
        if ($request->ajax()) {
            $search = $request->get('query');
            $departmentSpecializations = DepartmentSpecializations::has('Department')->orderBy('id', 'desc')->where(function ($q) use ($search) {
                if (!empty($search)) {
                    $q->where('name', 'like', '%' . $search . '%');
                }
            })->paginate(6);
        }
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "departmentSpecializations"=>$departmentSpecializations,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Specializations',
            ]
        ]);
    }
    //All Departments
    public function allDepartments($id)
    {
        $departments = DepartmentSpecializations::where('id', $id)->first();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "departments"=>$departments,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch Departments',
            ]
        ]);
    }
    //Get All Doctors
    protected function getAllDoctors(Request $request)
    {
        try {
            if ($request->ajax()) {
                $search = $request->get('query');
                $doctors = Doctor::has('department')->orderBy('id', 'desc')->whereHas('user', function ($query) use ($search) {
                    $query->where('username', 'like', '%' . $search . '%');
                })->paginate(6);
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "doctors"=>$doctors,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Fetch doctors',
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "doctors"=> dd($e->getMessage()),
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Error',
                ]
            ]);

        }
    }
}
