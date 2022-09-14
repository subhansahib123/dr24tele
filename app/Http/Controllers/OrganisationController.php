<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index(){
        $baseUrl=config('services.ehr.baseUrl');
        $apiKey=config('services.ehr.apiKey');
        $userInfo=session('loggedInUser');
        if (!empty($userInfo)) {
            $userInfo = json_decode(json_encode($userInfo), true);
            $token = $userInfo['sessionInfo']['token'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseUrl.'rest/admin/organisation/v2/hierarchy?order=ASC',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization:'.$token,
                    'apikey:'.$apiKey
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            try{
                if($response==false){
                    return curl_error($curl);
                }else {
                    $organizations=json_decode($response);
                    foreach($organizations as $organization){
                        Organization::updateOrCreate(
                            ['name'=>$organization->name],
                            [
                            'name'=>$organization->name,
                            'slug'=>$organization->name,
                            'level'=>$organization->level,
                        ]);
                    }
                    return  view('admin_panel.organization.show',["organizations"=>$organizations]);
                }
            }
            catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
