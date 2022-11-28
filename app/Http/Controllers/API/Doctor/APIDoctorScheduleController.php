<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIDoctorScheduleController extends Controller
{
    public function insert(Request $request)
    {
        $rules = array(
            'start' => 'required',
            'end' => 'required',
            'price' => 'required',
            'interval' => 'required',
            'number_of_people' => 'required',
            'comment' => 'required',
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
        } else {
            if ($request->has('status')) {
                $status = 1;
            } else {
                $status = 0;
            }
            $start = new Carbon($request->get('start'));
            $end = new Carbon($request->get('end'));
            $price = $request->get('price');
            $interval = $request->get('interval');
            $number_of_people = $request->get('number_of_people');
            $comment = $request->get('comment');
            $doctorId = Auth::user()->doctor->id;
            $schedule = Schedule::create([
                'start' => $start,
                'end' => $end,
                'status' => $status,
                'price' => $price,
                'interval' => $interval,
                'number_of_people' => $number_of_people,
                'comment' => $comment,
                'doctor_id' => $doctorId,
            ]);
            if ($schedule){
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "Schedule"=>$schedule,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Schedule Successfully Created',
                    ]
                ]);
            }
        }
    }
    //list schedules
    public function schedules()
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
        $user_id = auth()->user()->id;
        // dd($user_id);
        $doctor_id = Doctor::where('user_id', $user_id)->first()->id;
        $schedules = Schedule::where('doctor_id', $doctor_id)->get();
        // dd($schedules);
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                'schedules' => $schedules
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Schedules Fetch Successfully',
            ]
        ]);
    }
    //Update
    public function update(Request $request,$id)
    {
        $rules = array(
            'start' => 'required',
            'end' => 'required',
            'price' => 'required',
            'interval' => 'required',
            'number_of_people' => 'required',
            'comment' => 'required',
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
        } else {
            $start = new Carbon($request->get('start'));
            $end = new Carbon($request->get('end'));
            $status = $request->get('status');
            $price = $request->get('price');
            $interval = $request->get('interval');
            $number_of_people = $request->get('number_of_people');
            $comment = $request->get('comment');
            $doctorId = Auth::user()->doctor->id;
            $schedule = Schedule::find($id);
            $schedule->update([
                'start' => $start,
                'end' => $end,
                'status' => $status,
                'price' => $price,
                'interval' => $interval,
                'number_of_people' => $number_of_people,
                'comment' => $comment,
                'doctor_id' => $doctorId,
            ]);
            if ($schedule){
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "Schedule"=>$schedule,
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Schedule Successfully Updated',
                    ]
                ]);
            }
        }
    }
    //delete single schedule
    public function delete($id)
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
        $schedule = Schedule::find($id);

        if (isset($schedule)){
            $schedule = $schedule->delete();
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "Schedule"=>$schedule,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'Schedule Deleted Successfully  ',
                ]
            ]);
        }
        else{
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "Schedule" => "",
                ],
                'message' => [
                    "status_code" => 200,
                    'msg_status' => 'Schedule Already Deleted',
                ]
            ]);
        }

    }
}
