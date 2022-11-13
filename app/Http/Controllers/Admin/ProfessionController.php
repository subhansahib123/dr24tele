<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    // Function to create professions
    public function professions()
    {
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        dd(session());
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
                    curl_close($curl);
                    return curl_error($curl);
                } else {
                    $professions = json_decode($response);
                    foreach ($professions as $profession) {
                        Profession::firstOrCreate([
                            'name' => $profession->profession,
                        ]);
                        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                            curl_close($curl);
                            return  view('admin_panel.profession.show', ["professions" => $professions]);
                        } else if (isset($profession->message) && $profession->message == "API rate limit exceeded") {
                            curl_close($curl);
                            return redirect()->route('login.show')->withErrors(['error' => $profession->message]);
                        } else if (isset($profession->message) && $profession->message == "Invalid User") {
                        
                            curl_close($curl);
                            return redirect()->route('login.show')->withErrors(['error' => $profession->message]);
                        } else if (isset($profession->message) && $profession->message == "Invalid Token") {
                        
                            curl_close($curl);
                            return redirect()->route('login.show')->withErrors(['error' => $profession->message]);
                        } else {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $profession->message]);
                        }
                    }
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
               
            }
        } else {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
    }
}
