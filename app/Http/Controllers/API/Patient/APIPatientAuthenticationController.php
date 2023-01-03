<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\User;
use App\Models\UsersOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
//    Get Organizations
    public function getOrganizations(){
        $organizations = Organization::all();
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
                'msg_status' => 'Family Member is Successfully Created',
            ]
        ]);
    }
//    Register
    public function patientSignUp(Request $request)
    {
        $rules=array(
            'givenName' => 'required|string',
            'email' => 'required',
            'gender_code' => 'required|string',
            'phoneNumber' => 'required|string',
            'dateOfBirth' => 'required',
            'orguuid' => 'required',
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
        }
        else {
            if ($request->hasFile('image')) {
                $request->validate(['image' => 'required|mimes:jpg,png,gif,svg,jpeg|dimensions:min_width=300,min_height=350']);
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/patient/') . date('Y'), $getImage);
                $image = $getImage;
            } else {
                $image = '';
            }
            if ($request->hasFile('reg_img')) {
                $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->reg_img->getClientOriginalExtension();
                $request->reg_img->move(public_path('uploads/patient/registrationCard') . date('Y'), $getImage);
                $reg_img = $getImage;
            } else {
                $reg_img = '';
            }
            // dd($image,$reg_img);
            $user = User::firstOrCreate([
                'username' => '',
                'name' => $request->givenName,
                'password' => '',
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonUuid' => Str::uuid(),
                'status' => 1,
                'image' => $image

            ]);
            $orgUuid = $request->orguuid;
            // dd($user, $orgUuid);
            return $this->patientMapped($user, $orgUuid);
        }
    }
    protected function patientMapped($user, $orgUuid)
    {
        try {
            $user = User::where('PersonUuid', $user->PersonUuid)->first();
            $org = Organization::where('uuid', $orgUuid)->first();
            $patient = Patient::firstOrCreate([
                'user_id' => $user->id,
                'organization_id' => $org->id,
                'status' => 1,
            ]);
            $patientOrg = UsersOrganization::firstOrCreate([

                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $user->id,
                'organization_id' => $org->id
            ]);
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "patient"=>$user,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Patient is Successfully created',
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "msg"=>$e->getMessage(),
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Error',
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
