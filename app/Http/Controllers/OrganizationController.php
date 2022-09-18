<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;



class OrganizationController extends Controller
{
    public function organization(Request $request)
    {

        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo))
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        $token = $userInfo['sessionInfo']['token'];
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . 'rest/admin/v1/organization?=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));


        try {
            $response = curl_exec($curl);
            if ($response == false) {
                $error = curl_error($curl);
                return $error;
            } else {
                $organizations = json_decode($response);
                foreach ($organizations as $organization) {
                    Organization::firstOrCreate([
                        'name' => $organization->displayname,
                        'slug' => Str::slug($organization->displayname),
                        'uuid' => $organization->uuid,
                        'status' => $organization->status
                    ]);
                }
                if ( curl_getinfo($curl, CURLINFO_HTTP_CODE)==200) {
                    curl_close($curl);
                    return view('admin_panel.organization.show', ['organizations' => $organizations]);
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'You are not Authorized']);
                }
                else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => 'Unauthorized']);
                }
                else if (isset($organizations->message) && $organizations->message = "API rate limit exceeded") {
                    return redirect()->back()->withErrors(['error'=>__('API rate limit exceeded.')]);
                } else if (isset($organizations->message) && $organizations->message = "Invalid Token") {
                    return redirect()->back()->withErrors(['error'=>__('Invalid Token.')]);
                } else {
                    return redirect()->back()->withErrors(['error'=>__('Unknow Error From Api.')]);
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return view(
            'admin_panel.organization.create',
            [
                'organizations' => $organizations,
                'countries' => $countries

            ]
        );
    }
    public function createOrganization(Request $request)
    {



        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|string',
            'contactperson' => 'required|string',
            'phone' => 'required|string',
            'building' => 'string',
            'postalCode' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
        ]);
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo))
            return redirect()->route('login.show')->withErrors(['error' => 'Token Expired Please Login Again !']);
        $token = $userInfo['sessionInfo']['token'];
        $data = [
            "displayname" => $request->displayname,
            "name" => $request->name,
            "type" => 'company',
            "status" => $request->status,
            "pparent" => [
                "uuid" => "c6bc6265-e876-414a-9672-a85e09280059"
            ],
            "email" => $request->email,
            "contactperson" => $request->contactperson,
            "phone" => $request->phone,
            "address" => [
                [
                    "type" => "permanent",
                    "building" => $request->building,
                    "district" => $request->district,
                    "city" => $request->city,
                    "state" => $request->state,
                    "country" => $request->country,
                    "postalCode" => $request->postalCode
                ]
            ],
            "level" => "SubOrg"
        ];
        // dd($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $baseUrl .'rest/admin/organisation/v2',
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
                'Authorization:' . $token,
                'apikey: ' . $apiKey,
            ),
        ));
        try {
            $response = curl_exec($curl);
            
            //  var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            if ($response == false) {
                $error = curl_error($curl);
                 return redirect()->back()->withErrors(['error'=>__($error)]);;
            } else {
                $organization = json_decode($response);

                if ( isset($organization->displayname) 
                    && $organization->displayname
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE)==200 
                    || curl_getinfo($curl, CURLINFO_HTTP_CODE)==201
                ) {
                    // dd($or ganization);
                   Organization::Create([
                    'name'=>$request->name,
                    'uuid'=>$organization->uuid,
                    'slug'=>$organization->displayname,
                    'status'=>$organization->status,
                    'level'=>'SubOrg',
                   ]);

                   
                    curl_close($curl);
                    
                    return redirect()->back()->withSuccess(__('Successfully Organization Created'));
                } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 409) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
                else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 400) {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $organization->message]);
                }
                else if (isset($organization->message) && $organization->message = "API rate limit exceeded") {
                    return redirect()->back()->withErrors(['error'=>__('API rate limit exceeded.')]);
                } else if (isset($organization->message) && $organization->message = "Invalid Token") {
                    return redirect()->back()->withErrors(['error'=>__('Invalid Token.')]);
                } else {
                   
                    return redirect()->back()->withErrors(['error' => "Unknow Error From Api"]);
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function states($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
    public function cities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
}
