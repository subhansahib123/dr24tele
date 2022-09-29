<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\UsersOrganization;
use App\Models\Organization;


class HospitalPatientController extends Controller
{
    public function createHospitalPatients()
    {
        $users = User::all();
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $orgId = $userInfo['sessionInfo']['orgId'];

        return view('hospital_panel.patients.create', ['users' => $users,'orgId'=>$orgId]);
    }
    public function storeHospitalPatients(Request $request)
    {

        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)){
            Auth::logout();
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            'givenName' => $request->givenName,
            'middleName' => $request->middleName,
            'gender' => [
                'genderCode' => $request->genderCode,
            ],
            'prefix' => $request->prefix,
            'phoneExt' => $request->phoneExt,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'maritalStatus' => $request->maritalStatus,
        ];
        $params = array('userUuid' => $request->userUuid);


        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/person?' . http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: ' . $token,
                'apikey: ' . $apiKey,
            ),
        ));
        try {

            $response = curl_exec($curl);
            // dd($response);
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {

                $patients = json_decode($response);


                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    $user = User::where('uuid', $request->userUuid)->first();
                    curl_close($curl);
                    $user->update([
                        'PersonId' => $patients->PersonId,
                    ]);
                    $users = User::where('PersonId', $patients->PersonId)->first();

                    $org = Organization::where('uuid', $request->orgId)->first();

                    Patient::firstOrCreate([
                        'user_id' => $users->id,
                        'organization_id' => $org->id,
                        'status' => 1,
                    ]);
                    UsersOrganization::firstOrCreate([

                        'status' => 1,
                        'registration_code' => '123ABC',
                        'user_id' => $users->id,
                        'organization_id' => $org->id
                    ]);
                    return redirect()->back()->withSuccess(__('Patient Successfully Created'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not authorized to create person or EHR for person']);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'invalid useruuid / Please provide userUuid']);
                } else if (isset($patients->message) && $patients->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($patients->message) && $patients->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    curl_close($curl);


                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            curl_close($curl);

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
