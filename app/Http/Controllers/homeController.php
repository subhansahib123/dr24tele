<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\ReferancePatient;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\AgoraToken\Src\RtcTokenBuilder;
use App\Models\City;
use App\Models\DepartmentSpecializations;
use App\Models\DoctorSpecialization;
use App\Models\SpecializedDepartment;
use App\Models\State;
use Carbon\Carbon;

class homeController extends Controller
{
    public function index(Request $request)
    {
        // dd(session('currency_rate'));
        $organizations = Organization::where('featured_status',1)->where('status','Enabled')->get();
        // dd($organizations);
        return view('public_panel.index', compact('organizations'));
    }
    public function index2(Request $request)
    {

        $organizations = Organization::has('department')->orderBy('id', 'desc')->paginate(6);
        return view('public_panel.index01', compact('organizations'));
    }
    protected function allHospitals(Request $request)
    {
        try {
            if ($request->ajax()) {
                $search = $request->get('query');
                $organizations = Organization::has('department')->orderBy('id', 'desc')->where(function ($q) use ($search) {
                    if (!empty($search)) {
                        $q->where('name', 'like', '%' . $search . '%');
                    }
                })->paginate(6);
                return view('public_panel.index', compact('organizations'))->render();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function ourServices()
    {
        return view('public_panel.OurServices');
    }
    public function hospitalDetails($id)
    {
        // \DB::enableQueryLog(); // Enable query log
        $hospital = Organization::has('department')->where('id', $id)->first();
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();


        // $departments=Department::has('doctor')->orderBy('id','desc')->paginate(6);
        // dd(\DB::getQueryLog()); // Show results of log
        $state = State::where('id', $hospital->state)->first();
        $city = City::where('id', $hospital->city)->first();
        $stateName = $state->name;
        $cityName = $city->name;

        // dd($hospital->departments);
        return view('public_panel.hospital_details', compact('hospital', 'stateName', 'cityName', 'departmentSpecializations'));
    }
    //All Departments
    public function allDepartments($id)
    {

        $departments = DepartmentSpecializations::where('id', $id)->first();
        // dd($departments);
        return view('public_panel.all_departments', compact('departments'));
    }
    protected function getAllDepartments(Request $request)
    {
        try {
            if ($request->ajax()) {
                $search = $request->get('query');
                $departments = Department::has('doctor')->orderBy('id', 'desc')->where(function ($q) use ($search) {
                    if (!empty($search)) {
                        $q->where('name', 'like', '%' . $search . '%');
                    }
                })->paginate(6);
                return view('public_panel.all_departments', compact('departments'))->render();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function departmentDetails($id)
    {
        $department = Department::where('id', $id)->first();
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
        $doctors = Doctor::with('user', 'specializedDoctor')->where('department_id', $id)->get();
        // dd( $department,$doctors);y
        $state = State::where('id', $department->organization->state)->first();
        $city = City::where('id', $department->organization->city)->first();
        $stateName = $state->name;
        $cityName = $city->name;

        return view('public_panel.department_details', compact('department', 'doctors', 'departmentSpecializations', 'stateName', 'cityName'));
    }
    public function doctorDetails($id)
    {
        $doctor = Doctor::with('user', 'specializedDoctor')->where('id', $id)->first();
        $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
        // dd( $department,$doctors);y

        return view('public_panel.doctor_details', compact('doctor', 'departmentSpecializations'));
    }
    //All Doctors
    public function allDoctors($id)
    {

        $doctors = DoctorSpecialization::where('id', $id)->first();
        // dd($doctors);
        return view('public_panel.all_doctors', compact('doctors'));
    }
    public function doctorSpecializations(Request $request)
    {

        $doctorSpecializations = DoctorSpecialization::has('specializedDoctor')->get();
        if ($request->ajax()) {
            $search = $request->get('query');
            $doctorSpecializations = DoctorSpecialization::has('specializedDoctor')->orderBy('id', 'desc')->where(function ($q) use ($search) {
                if (!empty($search)) {
                    $q->where('name', 'like', '%' . $search . '%');
                }
            })->paginate(6);
        }
        // dd($doctorSpecializations);
        return view('public_panel.DoctorSpecialization', compact('doctorSpecializations'));
    }
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
        // dd($departmentSpecializations);
        return view('public_panel.DepartmentSpecialization', compact('departmentSpecializations'));
    }
    protected function getAllDoctors(Request $request)
    {
        try {
            if ($request->ajax()) {
                $search = $request->get('query');
                $doctors = Doctor::has('department')->orderBy('id', 'desc')->whereHas('user', function ($query) use ($search) {
                    $query->where('username', 'like', '%' . $search . '%');
                })->paginate(6);
                return view('public_panel.all_doctors', compact('doctors'))->render();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function departmentsOfHospital($orgid)
    {
        $departments = Department::has('doctor')->where('organization_id', $orgid)->get();
        return view('public_panel.departments', compact('departments'));
    }
    public function doctorsOfDepartment($dptId)
    {
        $doctors = Doctor::has('schedule')->where('department_id', $dptId)->get();
        // dd($doctors);
        return view('public_panel.doctors', compact('doctors'));
    }
    public function appointment($id)
    {
        // dd(Auth::check());
        if (isset(auth()->user()->patient)) {
            $doctor = Doctor::with('user', 'specialization')->find($id);
            // dd($doctor);
            return view('public_panel.appointment', compact('doctor'));
        } else {
            session_start();
            unset($userInfo);

            Session::flush();
            Auth::logout();
            return redirect()->route('patient.login')->withErrors(['error' => 'Please login!']);
        }
    }
    public function scheduleOfDoctor($doctor_id, $date,$patient_id)
    {
        // $timeZone=implode('/',explode('-',$date));
        $user_id = Doctor::find($doctor_id);
        $schdeules =Schedule::
        // where('start_date','>=',$date )
            // ->
            where('doctor_id', $doctor_id)
            ->get();
        // $user_id=Auth::user();
        // return response()->json( $schdeules);
      $timeZone=  User::find($patient_id)->timezone;
        foreach($schdeules as $schdeule){
           $schdeule->start= Carbon::parse($schdeule->start)->timezone($timeZone)->format('h:i A');
           $schdeule->end= Carbon::parse($schdeule->end)->timezone($timeZone)->format('h:i A');
        }
        return response()->json(['schedules' => $schdeules, 'user_id' => $user_id->user_id]);
    }
    public function daySchedule($id)
    {
        $schdeule = Schedule::find($id);
        return response()->json(['schedules' => $schdeule]);
    }
    public function scheduleOfDoctorCoupon($schedule_id, $coupon)
    {
        $schdeules = Schedule::find($schedule_id);
        if ($coupon != 'coupon') {
            $cop = Coupon::where('title', '=', $coupon)->first();
            if ($cop) {
                $schdeules->price = $schdeules->price - $cop->discount;
            }
        }
        return response()->json(['schedules' => $schdeules]);
    }
    public function bookApppointment(Request $request)
    {
        $data = $request->all();

        //  Stripe\Stripe::setApiKey('sk_test_4mIgs731P1pD8aEEO57Ytf5v');
        // Stripe\Charge::create ([
        //         "amount" => intval($request->fee) * 100,
        //         "currency" => "inr",
        //         "source" => $request->stripeToken,
        //         "description" => "Making test payment."
        // ]);
        Schedule::where('id',$data['schedule_id'])->decrement('number_of_people', 1);
        $data['start']=Carbon::createFromTimeString($data['start'],'Asia/Calcutta')->format('H:i');
        $data['end']=Carbon::createFromTimeString($data['end'],'Asia/Calcutta')->format('H:i');
        $appointment = Appointment::create($data);
        // $coupon = Coupon::where('title', '=', $data->coupon)->first();
        // PatientCoupon::create(['organization_id' => $data->hospital,
        //     'patienet_id'=> $data->patient_id,
        //     'coupon_id' => $coupon->id,
        //     'used_date' => Carbon\Carbon::now()]);

        if(isset($request->patient_name)){
            ReferancePatient::create(['patient_name'=>$request->patient_name, 'patient_phone'=>$request->patient_phone,'appointment_id'=>$appointment->id]);
        }
        return response()->json(["msg" => $appointment->id]);
    }

    public function storeToken(Request $request)
    {
        // dd(Auth::user());
        $id = $request->user_id;

        User::find($id)->update(['device_key' => $request->token]);
        // auth()->user()->update(['device_key'=>$request->token]);
        return response()->json($request->token);
    }

    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where('id', $request->user_id)->whereNotNull('device_key')->pluck('device_key')->first();
        // dd($FcmToken);
        $serverKey = 'AAAAbIgbEU8:APA91bFMDoPB9ES0j9z5TGtBx2cRQtgwn8Odqbs4z4b4zuv0k7hgrxgo4l1A7PEIpDJLRWzyo0Fv8swJBGDJbhPoocHTn-_qzk5LL9wfHxRmAmyZjHU0RfODsiGd0pzJ1pyUgcCB4BAh';
        // dd($request->link);
        $conference_link = '';
        if ($request->has('link') && $request->link == 'true') {
            $channelName = "DrTele" . rand() . $request->user_id . "channel";
            $owner_id = $request->owner;
            // $agoraToken = $this->generate_token($channelName, $owner_id);
            $conference_link = 'https://virtual-care.drtele.co/tilde_' . $channelName;
            $patient_link = 'https://virtual-care.drtele.co/tilde_' . $channelName;

            $data = [
                "to" => $FcmToken,
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,
                    "data" => ['conference_link' => $conference_link, 'patient_link' => $patient_link]
                ]



            ];
            $str = $request->title;
            preg_match_all('!\d+!', $str, $appointment_id);
            Appointment::where('id',$appointment_id)->update(['Call_Status'=>1,'appointment_link'=>$conference_link]);

        } else {
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

        return response()->json(['fire_base' => $result, 'conference_link' => $conference_link]);
    }
    public function generate_token($channelName, $user_id)
    {


        $appID = "e4fc13e59b1d4105b5dd434a56a2bf94";
        $appCertificate = "46369135cce54217935851efd0844afb";

        $uidStr = strval($user_id);
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 2400;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('Asia/Karachi')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, 0, $role, $privilegeExpiredTs);



        // $obj = ["token" => $token];

        return  $token;
    }
}
