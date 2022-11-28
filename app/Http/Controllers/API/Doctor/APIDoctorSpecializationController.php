<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\SpecializedDoctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIDoctorSpecializationController extends Controller
{
    public function index()
    {
        $specializations = DoctorSpecialization::all();
        $uuid = Auth::user()->uuid;
        $user = User::with('doctor')->where('uuid', $uuid)->first();
        // dd($doctor->specialization_id);
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "user"=>$user,
                'specializations' => $specializations,
            ],
            'message' => [
                "status_code" => 200,
                'msg_status' => 'Details Fetched Successfully',
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rules = array(
            'specialization' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => $validator->errors(),
                'message' => [
                    "status_code" => 200,
                    'msg_status' => 'Please fill the the required fields',
                ]
            ]);
        }
        //  dd($userInfo);
        $uuid = Auth::user()->uuid;
        $user = User::with('doctor')->where('uuid', $uuid)->first();
        $doctor = Doctor::where('user_id', $user->id)->first();
        // dd($request->specialization );
        $specialized = SpecializedDoctor::firstOrCreate([
            'doctor_id'=>$doctor->id,
            'specialization_id'=>$request->get('specialization'),
        ]);
        if ($specialized){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => $specialized,
                'message' => [
                    "status_code" => 200,
                    'msg_status' => 'Your Specialization is Successfully Saved',
                ]
            ]);
        }
    }
}
