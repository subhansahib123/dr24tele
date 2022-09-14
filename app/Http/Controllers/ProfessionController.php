<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{
    public function profession(Request $request)
    {


        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $token = $userInfo['sessionInfo']['token'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/profession?order=ASC&=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: ' . $token,
                'apikey: ' . $apiKey,
            ),
        ));


        try {
            $response = curl_exec($curl);

            curl_close($curl);
            if ($response == false) {
                $error = curl_error($curl);
                return $error;
            } else {
                $professions = json_decode($response);
                foreach ($professions as $profession) {
                    Profession::firstOrCreate([
                        'name' => $profession->profession,
                        
                    ]);
                }
                if(isset($professions->message) && $professions->message="API rate limit exceeded"){
                    return view('admin_panel.patient.show')->withError(__('API rate limit exceeded.'));
                }else if(isset($professions->message) && $professions->message="Invalid Token"){
                    return view('admin_panel.patient.show')->withError(__('Invalid Token.'));
                }else{
                    return view('admin_panel.profession.show', ['professions' => $professions]);

                }
                // dd($profession);
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
