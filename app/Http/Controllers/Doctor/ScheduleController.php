<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\PatienDocument;
use App\Models\Patient;

// use Illuminate\Support\Arr;
 class ScheduleController extends Controller
{
    //load doctors schedule create
    public function createSchedule(Schedule $schedule)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $user_id = auth()->user()->id;
        // dd($user_id);
        $doctor_id = Doctor::where('user_id', $user_id)->first()->id;


        $days=$schedule::DAYS;
        return view('doctor_panel.schedule.create', compact('doctor_id','days'));
    }
    //store schedule
    public function insert(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        if ($request->has('status')) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        if ($request->has('repeat')) {
            $data['repeat'] = 1;
        } else {
            $data['repeat'] = 0;
        }
        
// dd($data);
        $start_date = new Carbon($data['start_date']);
        $end_date = new Carbon($data['end_date']);
        $start = new Carbon($data['start']);
        $end = new Carbon($data['end']);
        $data['start'] = $start->format("H:I");
        $data['start_date']=$start_date;

        $data['end'] = $end->format("H:I");
        if($request->end_date)
        $data['days']=implode($data['days'],',');
        $data['end_date']=$end_date;
        // dd($data);
        $schedule = Schedule::create($data);

        return redirect()->route('list.schedules.doctor')->withSuccess(__('Schedule Successfully Created'));
        // $interval=$data['interval']." minutes";

        // $period =new CarbonPeriod($start, $interval,$end);
        // $slots = [];
        // foreach ($period as $item) {
        //     $start_time=$item->format("h:i A");
        //     $end_time=$item->addMinutes($data['interval'])->format("h:i A");

        //     $slot=Slot::create([
        //         'start'=>new Carbon($start_time),
        //         'end'=>new Carbon($end_time),
        //         'status'=>1,
        //         'schedule_id'=>$schedule->id,
        //         'price'=>$data['price']
        //     ]);
        //     array_push($slots, ['slot'=>$item->format("h:i A"),'slot_id'=>$slot->id,'price'=>$data['price']]);

        // }



        // return response()->json(['schedule_id'=>$schedule->id,'slots'=>$slots]);


    }
    public function edit($id)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $schedule = Schedule::find($id);
        return view('doctor_panel.schedule.edit', compact('schedule'));
    }
    public function update(Request $request)
    {
        $data = $request->all();
        if ($request->has('status')) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        // dd($request->all());
        $request->validate([
            'start' => 'required',
            'end' => 'required',
            'price' => 'required',
            'interval' => 'required',
            'number_of_people' => 'required',
            'comment' => 'required',
            'status' => 'required',

        ]);

        $start = new Carbon($data['start']);
        $end = new Carbon($data['end']);
        $data['start'] = $start;

        $data['end'] = $end;


        // dd($data);
        $schedule = Schedule::find($request->id)->update($data);

        return redirect()->route('list.schedules.doctor')->withSuccess(__('Schedule Successfully Updated'));
    }
    //list schedules
    public function schedules()
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $user_id = auth()->user()->id;
        // dd($user_id);
        $doctor_id = Doctor::where('user_id', $user_id)->first()->id;
        $schedules = Schedule::where('doctor_id', $doctor_id)->get();
        // dd($schedules);
        return view('doctor_panel.schedule.index', ['schedules' => $schedules]);
    }
    //delete single schedule
    public function delete($id)
    {
        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        Schedule::find($id)->delete();
        return redirect()->back()->withSuccess(__('Successfully delete schdule'));
    }
    public function appointments()
    {

        if (!Auth::check())
            return redirect()->route('logout')->withErrors(['error' => 'Login Token Expired ! Please login Again']);
        $doctor_id = auth()->user()->doctor->id;
        $appointements = Appointment::where('doctor_id', $doctor_id)->get();
        return view('doctor_panel.appointement.index', compact('appointements'));
    }
    public function appointmentDetails($id)
    {
        $appointment=Appointment::where('id',$id)->first();
        $schedule=Schedule::where('id',$appointment->schedule_id)->first();
        $patient=Patient::where('id',$appointment->patient_id)->first();
        $records=PatienDocument::where('patient_id',$patient->id)->get();
        // dd($records     );

        return view('doctor_panel.appointement.details',compact('appointment','schedule','records','patient'));
    
    }

    public function appointmentList(){
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
        $doctor_id = auth()->user()->doctor->id;
        // dd($doctor_id);
        $appointements = Appointment::with('doctor')->where('doctor_id', $doctor_id)->get();
        return response()->json([
            'status' => [
                'status_code' => 200,
                'message' => 'Ok'
            ],
            'data' => [
                "appointments"=>$appointements,
            ],
            'message' => [
                "status_code"=> 200,
                'msg_status' => 'Fetch All Appointments Successfully',
            ]
        ]);
    }
}
