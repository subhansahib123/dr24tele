<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIPersonalDetailsController extends Controller
{
    public function phoneNumberUpdated(Request $request)
    {
        $rules=array(
            'phoneNumber' => 'required|string',
            'newPhoneNumber' => 'required|string',
        );
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => $validator->errors(),
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Please fill the the required fields',
                ]
            ]);
        }else{
            $phoneNumber = $request->get('phoneNumber');
            $newPhoneNumber = $request->get('newPhoneNumber');
            $user = User::where('phone_number',$phoneNumber)->first();
            if ($user) {
                $user->update([
                    'phone_number' => $newPhoneNumber,
                ]);
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "user"=>$user,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Phone Number Successfully Updated',
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "user"=>"",
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Current Phone Number is not correct',
                    ]
                ]);

            }
        }
    }
    //Update Name
    public function displayNameUpdated(Request $request)
    {
        $rules=array(
            'name' => 'required|string',
        );
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => $validator->errors(),
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Please fill the the required fields',
                ]
            ]);
        }else{
            $name = $request->get('name');
            $id=Auth::user()->id;
            $user=User::where('id',$id)->first();
            $user->update(['name'=>$name]);
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "user"=>$user,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Display Name is Successfully Updated',
                ]
            ]);
        }
    }

    public function appointments(){
        $patient_id=auth()->user()->patient->id;
        // dd(Auth::user()->patient->id);
        $appointments=Appointment::with('doctor')->where('patient_id', $patient_id)->get();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "appointments"=>$appointments,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch All Appointments Successfully',
            ]
        ]);
    }
}
