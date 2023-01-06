<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIDoctorAuthenticationController extends Controller
{
    public function doctorLogin(Request $request)
    {
        $phoneNumber = $request->get('phoneNumber');
        $phoneNumber = '+'.$phoneNumber;
        $user = User::where('phone_number',  $phoneNumber)->first();
        if ($user) {
            if (!$user->doctor){
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => '',
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'user is not associated with any department',
                    ]
                ]);
            }
            Auth::login($user);
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "user"=>$user,
                    "token" => auth()->user()->createToken('API Token')->plainTextToken,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Successfully Login',
                ]
            ]);
        } else {
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => '',
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'No User Exist',
                ]
            ]);
        }
    }
}
