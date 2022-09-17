<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Str;



class OrganizationController extends Controller
{
    public function organization(Request $request)
    {

        $curl = curl_init();

        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');

        $userInfo=session('loggedInUser');
        $userInfo=json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if(is_null($userInfo))
             return redirect()->route('login.show')->withErrors(['error'=>'Token Expired Please Login Again !']);
        $token=$userInfo['sessionInfo']['token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/rest/admin/v1/organization?=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization:'.$token,
                'apikey: '.$apiKey,
            ),
        ));


        try{
            $response = curl_exec($curl);


        curl_close($curl);
            if($response==false){
                $error = curl_error($curl);
                return $error;
            }
            else{
                $organizations = json_decode($response);
                foreach($organizations as $organization){
                    Organization::firstOrCreate([
                        'name'=> $organization->displayname,
                        'slug'=> Str::slug($organization->displayname),
                        'uuid'=>$organization->uuid,
                        'status'=>$organization->status
                    ]);

                };
                if(isset($organizations->message) && $organizations->message="API rate limit exceeded"){
                    return view('admin_panel.organization.show')->withError(__('API rate limit exceeded.'));
                }else if(isset($organizations->message) && $organizations->message="Invalid Token"){
                    return view('admin_panel.organization.show')->withError(__('Invalid Token.'));
                }else{
                    return view('admin_panel.organization.show',['organizations'=>$organizations]);
                }

            }
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
    public function create(){
        $organizations=Organization::all();
        return view('admin_panel.organization.create',['organizations'=>$organizations]);
    }
    public function createOrganization(Request $request){
        $curl = curl_init();
        $data =[            "displayname"=> $request->displayname,
            "name"=> $request->username,
            "type"=> 'company',
            "status"=> $request->status,
            "pparent"=> [
                "uuid"=>"c6bc6265-e876-414a-9672-a85e09280059"
            ],
            "email"=> $request->email,
            "contactperson"=> $request->contactperson,
            "phone"=> $request->phone,
            "address"=> [
                [
                "type"=> "permanent",
                "building"=> $request->building,
                "district"=> $request->district,
                "city"=> $request->city,
                "state"=> $request->state,
                "country"=> $request->country,
                "postalCode"=> $request->postalCode
                ]
            ],
            "level"=> "SubOrg"
        ];
        curl_setopt_array($curl, array(
        CURLOPT_URL =>  $baseUrl .'/rest/admin/organisation/v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization:'.$token,
            'apikey: '.$apiKey,
        ),
        ));
        try{
            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
}
