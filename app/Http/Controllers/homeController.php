<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\AgoraToken\Src\RtcTokenBuilder;

class homeController extends Controller
{
    public function index(Request $request){

        $organizations=$this->allHospitals($request);
        if ($request->ajax()) {
            return view('public_panel.index', compact('organizations'));
        }
        return view('public_panel.index',compact('organizations'));
    }
    protected function allHospitals(Request $request){
        try{
            $query = $request->get('query');
            $organizations=Organization::has('department')->where(function ($q) use ($query){
                if (!empty($query)) {
                    $q->where('name', 'like', '%' . $query . '%');
                }
            })->paginate(6);
            //  dd($organizations);
        }
        catch (\Exception $e){
            dd($e->getMessage());

        }
        return $organizations;


    }
    public function departmentsOfHospital($orgid){
        $departments=Department::has('doctor')->where('organization_id',$orgid)->get();
        return view('public_panel.departments',compact('departments'));
    }
    public function doctorsOfDepartment($dptId){
        $doctors=Doctor::has('schedule')->where('department_id',$dptId)->get();
        // dd($doctors);
        return view('public_panel.doctors',compact('doctors'));
    }
    public function appointment(){
        if(Auth::check())
            return view('public_panel.appointment');
        else
            return redirect()->route('patient.login')->withErrors(['error'=>'Please login!']);
    }
    public function scheduleOfDoctor($doctor_id,$date){
        $date=$date." 00:00:00";
        $user_id=Doctor::find($doctor_id);
        $schdeules=Schedule::whereDate('start', '=', $date." 00:00:00")

            ->where('doctor_id',$doctor_id)->get();
        return response()->json( ['schedules'=>$schdeules,'user_id'=>$user_id->user_id]);
    }
    public function bookApppointment(Request $request){
        $data=$request->all();
        $appointment=Appointment::create($data);
        return response()->json(["msg"=> $appointment->id]);
    }

    public function storeToken(Request $request)
    {
        // dd(Auth::user());
        $id=$request->user_id;

        User::find($id)->update(['device_key'=>$request->token]);
        // auth()->user()->update(['device_key'=>$request->token]);
        return response()->json($request->token);
    }

    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where('id',$request->user_id)->whereNotNull('device_key')->pluck('device_key')->first();
        // dd($FcmToken);
        $serverKey = 'AAAAbIgbEU8:APA91bFMDoPB9ES0j9z5TGtBx2cRQtgwn8Odqbs4z4b4zuv0k7hgrxgo4l1A7PEIpDJLRWzyo0Fv8swJBGDJbhPoocHTn-_qzk5LL9wfHxRmAmyZjHU0RfODsiGd0pzJ1pyUgcCB4BAh';
        // dd($request->link);
        $conference_link='';
        if($request->has('link') && $request->link=='true'){
            $channelName=rand().$request->user_id;
            $agoraToken=$this->generate_token($channelName);
            $conference_link=url('/').'/conference/call/'.$channelName.'/'.urlencode($agoraToken);
            $data = [
                "to" => $FcmToken,
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,
                    "data"=> $conference_link


                ]
            ];
        }else {
            $data = [
                "to" => $FcmToken,
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,


                ]
            ];
        }

        // dd($data);
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);

        return response()->json(['fire_base'=>$result,'conference_link'=>$conference_link]);
    }
    public function generate_token($channelName)
    {


        $appID = "e4fc13e59b1d4105b5dd434a56a2bf94";
        $appCertificate = "46369135cce54217935851efd0844afb";
        // $channelName = $request->channel;
        $uid = (int) mt_rand(1000000000, 9999999999);
        $uidStr = strval($uid);
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 2400;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('Asia/Karachi')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, null, $role, $privilegeExpiredTs);



        // $obj = ["token" => $token];

        return  $token;

    }
}
