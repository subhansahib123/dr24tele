<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class APIPatientAuthenticationController extends Controller
{
    public function performLogin(Request $request)
    {
        $phoneNumber = $request->get('phoneNumber');
        $phoneNumber = '+'.$phoneNumber;
        $user = User::where('phone_number',  $phoneNumber)->first();
        if ($user) {
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
    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => '',
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Logout Successfully',
            ]
        ]);
    }
}
