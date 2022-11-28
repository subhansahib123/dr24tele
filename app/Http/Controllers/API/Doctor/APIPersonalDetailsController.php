<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIPersonalDetailsController extends Controller
{
    public function displayNameUpdated(Request $request)
    {
        if (!Auth::check()){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Login Token Expired ! Please login Again',
                ]
            ]);
        }
        $id=Auth::user()->id;
        $user=User::where('id',$id)->first();
        $name = $request->get('displayName');
        $user->update(['name'=>$name]);
        if ($user){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "user"=>$user
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Display Name is Successfully Updated',
                ]
            ]);
        }
    }
}
