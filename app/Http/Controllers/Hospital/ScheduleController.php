<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Slot;
use App\Models\Doctor;
use App\Models\Department;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    public function createSchedule()
    {
        $org_id=auth()->user()->user_organization->organization_id;
       $departments= Department::has('doctor')->where('organization_id',$org_id)->get();
    //    dd($departments);
       $deptAr=[];
       foreach($departments as $department){
        array_push($deptAr,$department->id);


       }
       $doctors=Doctor::with('user')->whereIn('department_id',$deptAr)->get();

        return view('hospital_panel.Schedule.create',compact('doctors'));
    }
    public function scheduleCreateOnEhr(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo))
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);

            $name=User::where('uuid',$request->uuid)->first();
        $token = $userInfo['sessionInfo']['token'];
        $data = [[
            'resourceType' => 'Schedule',
            'active' => 'true',
            'comment' => 'Applicable every day',
            'actor' => [
                'reference' => $baseUrl . 'Practitioner/userUuid-' .$request->uuid,
                'type' => 'Practitioner',
                'display' => $name,
            ],
            'active' => 'true',
            'planningHorizon' => [
                'start' => '',
                'end' => '',
            ],

        ]];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/appointment/Schedule',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: ' . $token
            ),
        ));
        try {
            $response = curl_exec($curl);
            dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $UpdatedRole = json_decode($response);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 201) {
                    curl_close($curl);

                    return redirect()->back()->withSuccess(__('Schedule Successfully Created '));
                } else {
                    curl_close($curl);

                    // dd(curl_getinfo($curl, CURLINFO_HTTP_CODE));
                    return redirect()->back()->withErrors(['error' => $UpdatedRole->message]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }
     public function insert(Request $request){
         $data=$request->all();
        if($request->has('status')){
            $data['status']=1;
        }else {
            $data['status']=0;
        }


        $start=new Carbon($data['start']);
        $end=new Carbon($data['end']);
        $data['start']=$start;

        $data['end']=$end;


        // dd($data);
        $schedule=Schedule::create($data);

        return redirect()->route('list.schedules')->withSuccess(__('Schedule Successfully Created'));
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
    //edit schedule
    public function edit($id){
        $schedule=Schedule::find($id);
        $doctor=Doctor::with('user')->where('id',$schedule->doctor_id)->first();
        return view('hospital_panel.Schedule.edit',compact('schedule','doctor'));

    }
    public function update(Request $request){
         $data=$request->all();
        if($request->has('status')){
            $data['status']=1;
        }else {
            $data['status']=0;
        }
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

        $start=new Carbon($data['start']);
        $end=new Carbon($data['end']);
        $data['start']=$start;

        $data['end']=$end;


        // dd($data);
        $schedule=Schedule::find($request->id)->update($data);

        return redirect()->route('list.schedules')->withSuccess(__('Schedule Successfully Updated'));
    }
    public function schedules(){
        $schedules=Schedule::all();
        return view('hospital_panel.Schedule.index',['schedules'=>$schedules]);
    }
    public function delete($id){
        Schedule::find($id)->delete();
        return redirect()->back()->withSuccess(__('Successfully delete schdule'));

    }

}
