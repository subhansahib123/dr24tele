<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function createSchedule()
    {
        return view('hospital_panel.Schedule.create');
    }
    public function scheduleCreate(Request $request)
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
    
}
