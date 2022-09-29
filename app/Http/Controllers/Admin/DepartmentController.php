<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Http\Request;
use Str;

class DepartmentController extends Controller
{
    public function departmentsList($uuid)
    {

        // dd($uuid);
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

        $req_url = $baseUrl . 'rest/admin/organisation/v2/hierarchy/' . $uuid;
        // dd($apiKey);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
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
            // dd($response);
            //  var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            if ($response == false) {
                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => __($error)]);;
            } else {
                $departments = json_decode($response);

                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    // dd($departments);
                    curl_close($curl);
                    if(isset($departments->childlist)){
                        $org = Organization::where('uuid', $uuid)->first();
                        foreach ($departments->childlist as $department) {
                            Department::firstOrCreate([
                                'name' => $department->name,
                                'slug' => Str::slug($department->name),
                                'organization_id' => $org->id,
                                'level' => 'SubOrg',
                                'uuid' => $department->uuid
                            ]);
                    }


                    return view('admin_panel.departments.show', ['departments' => $departments]);
                    }else {
                        return redirect()->back()->withErrors(['error' => __('No Record Found')]);
                    }




                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => __($departments->message)]);
                } else if (isset($departments->message) && $departments->message = "API rate limit exceeded") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('API rate limit exceeded.')]);
                } else if (isset($departments->message) && $departments->message = "Invalid Token") {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => __('Invalid Token.')]);
                } else {
                    curl_close($curl);

                    return redirect()->back()->withErrors(['error' => "Unknown Error From Api"]);
                }
            }
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
