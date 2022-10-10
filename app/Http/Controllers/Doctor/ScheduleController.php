<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Schedule;
use App\Models\Doctor;
class ScheduleController extends Controller
{
    //load doctors schedule create
    public function createSchedule()
    {
        if(!Auth::check())
            return redirect()->route('logout')->withErrors(['error'=>'Login Token Expired ! Please login Again']);
        $user_id=auth()->user()->id;
        // $doctor_id=Doctor::where('user_id',$user_id)->first()->id;
        dd($user_id);


        return view('doctor_panel.schedule.create',compact('doctor_id'));
    }
    //store schedule
    public function insert(Request $request){
        // dd($request->all());
        $request->validate([
            'start'=>'required',
            'end'=>'required',
            'price'=>'required',
            'interval'=>'required',
            'number_of_people'=>'required',
            'comment'=>'required',
            'status'=>'required',

        ]);
        $data=$request->all();
        $start=new Carbon($data['start']);
        $end=new Carbon($data['end']);
        $data['start']=$start;

        $data['end']=$end;

        if($request->has('status')){
            $data['status']=1;
        }else {
            $data['status']=0;
        }
        // dd($data);
        $schedule=Schedule::create($data);

        return redirect()->back()->withSucces(__('Successfully Created schedule'));
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
    //list schedules
    public function schedules(){
        $schedules=Schedule::all();
        return view('hospital_panel.Schedule.index',['schedules'=>$schedules]);
    }
    //delete single schedule
    public function delete($id){
        Schedule::find($id)->delete();
        return redirect()->back()->withSucces(__('Successfully delete schdule'));

    }
}
