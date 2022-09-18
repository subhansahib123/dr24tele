<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    // Function to create professions
    public function professions()
    {
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        if (!empty($userInfo)) {
            $userInfo = json_decode(json_encode($userInfo), true);
            $token = $userInfo['sessionInfo']['token'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseUrl . 'rest/admin/profession?order=ASC',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization:' . $token,
                    'apikey:' . $apiKey
                ),
            ));

            try {
                $response = curl_exec($curl);
                if ($response == false) {
                    return curl_error($curl);
                    curl_close($curl);
                } else {
                    $professions = json_decode($response);
                    foreach ($professions as $profession) {
                        Profession::firstOrCreate([
                            'name' => $profession->profession,
                        ]);
                        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {



                            curl_close($curl);
                            return  view('admin_panel.profession.show', ["professions" => $professions]);
                        } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => 'You are not authorized to view professions']);
                        } else {
                            return redirect()->back()->withErrors(['error' => __('Unknow Error From Api.')]);
                        }
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        else{
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
    }
}
