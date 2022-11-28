<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\FamilyMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIFamilyMembersController extends Controller
{
    //Create Family Members
    public function create(Request $request)
    {
        $rules=array(
            'memberName' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|integer',
            'relation' => 'required|string',
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
            $patientId = Auth::user()->patient->id;
            $memberName = $request->get('memberName');
            $email = $request->get('email');
            $phoneNumber = $request->get('phoneNumber');
            $relation = $request->get('relation');
            $user = FamilyMembers::where('name', $memberName)->where('patient_id', $patientId)->first();
            if ($user) {
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "user"=>$user->relation,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'This Member is Already Created with relation ' . $user->relation . '.Try to Update  Member',
                    ]
                ]);
            } else {
                $familyMember = FamilyMembers::firstOrCreate([
                    'name' => $memberName,
                    'email' => $email,
                    'phone_number' => $phoneNumber,
                    'relation' => $relation,
                    'patient_id' => $patientId,
                ]);
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "member"=>$familyMember,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Family Member is Successfully Created',
                    ]
                ]);
            }
        }
    }
    //List Of Members
    public function list()
    {
        $patientId = Auth::user()->patient->id;
        $all_members = FamilyMembers::where('patient_id', $patientId)->get();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "members"=>$all_members,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Family Member is Successfully Created',
            ]
        ]);
    }
    //Update Member
    public function update(Request $request)
    {
        $rules=array(
            'memberName' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|integer',
            'relation' => 'required|string',
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
            $memberId = $request->get('id');
            $memberName = $request->get('memberName');
            $email = $request->get('email');
            $phoneNumber = $request->get('phoneNumber');
            $relation = $request->get('relation');
            $member = FamilyMembers::find($memberId);
            // dd($member);
            $member->update([
                'name' => $memberName,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'relation' => $relation,
            ]);
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "member"=>$member,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Member Details are Successfully Updated',
                ]
            ]);
        }
    }
}
