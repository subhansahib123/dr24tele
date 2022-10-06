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
                        } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $professions->message]);
                        } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $professions->message]);
                        } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $professions->message]);
                        } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $professions->message]);
                        } else if (isset($professions->message) && $professions->message == "API rate limit exceeded") {
                            curl_close($curl);
                            return redirect()->back()->withErrors(['error' => $professions->message]);
                        }else if (isset($professions->message) && $professions->message == "Invalid User") {
                             
                            curl_close($curl);
                            return redirect()->route('logout')->withErrors(['error' => $professions->message]);
                        }  else if (isset($professions->message) && $professions->message == "Invalid Token") {
                             
                            curl_close($curl);
                            return redirect()->route('logout')->withErrors(['error' => $professions->message]);
                        }else {
                            curl_close($curl);

                            return redirect()->back()->withErrors(['error' => 'Unknown Error From Api.']);
                        }
                    }
                }
            } catch (\Exception $e) {
                curl_close($curl);

                return $e->getMessage();
            }
        } else {
             
            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
    }
}
