<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as clientRequest;
class PersonController extends Controller
{
    public function create(Request $request){
        $baseUrl=config('services.ehr.baseUrl');
        $apiKey=config('services.ehr.apiKey');
        $client = new Client();
        $Authorization = $request->header('Authorization');
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $Authorization,
            'apikey' => $apiKey
        ];
        $givenName = $request->givenName;
        $middleName = $request->middleName;
        $prefix = $request->prefix;
        $phoneExt = $request->phoneExt;
        $email = $request->email;
        $dateOfBirth = $request->dateOfBirth;
        $dobStatus = $request->dobStatus;
        foreach ($request->gender as $gender){
            $genderCode = $gender;
        }
        $addressArray = [];
        foreach ($request->address as $address){
            $addArr['type'] = $address['type'];
            $addArr['address1'] = $address['address1'];
            $addArr['address2'] = $address['address2'];
            $addArr['building'] = $address['building'];
            $addArr['taluk'] = $address['taluk'];
            $addArr['district'] = $address['district'];
            $addArr['city'] = $address['city'];
            $addArr['state'] = $address['state'];
            $addArr['country'] = $address['country'];
            $addArr['landMark'] = $address['landMark'];
            $addArr['postalCode'] = $address['postalCode'];
            $addArr['postOffice'] = $address['postOffice'];
            array_push($addressArray,$addArr);
        }
        $bloodGroup = $request->bloodGroup;
        $maritalStatus = $request->maritalStatus;
        $relationshipArray = [];
        foreach ($request->relationship as $relationship){
            $relation['type'] = $relationship['type'];
            $relation['careTakerPId'] = $relationship['careTakerPId'];
            array_push($relationshipArray,$relation);
        }
        $idproofArray = [];
        foreach ($request->idproof as $proof){
            $idproof['idNumber']=$proof['idNumber'];
            $idproof['type']=$proof['type'];
            $idproof['issueDate']=$proof['issueDate'];
            $idproof['expiryDate']=$proof['expiryDate'];
            $idproof['issuingAuthority']=$proof['issuingAuthority'];
            $idproof['placeOfIssue']=$proof['placeOfIssue'];
            array_push($idproofArray,$idproof);
        }
        $qualificationArray=[];
        foreach ($request->qualification as $qualification){
            $qf['qualification']=$qualification['qualification'];
            $qf['specialization']=$qualification['specialization'];
            $qf['institution']=$qualification['institution'];
            $qf['place']=$qualification['place'];
            $qf['year']=$qualification['year'];
            array_push($qualificationArray,$qf);
        }
        $economicCategory = $request->economicCategory['categoryCode'];
        $arrivedFrom = $request->visaDetails['arrivedFrom'];
        $nextDestination = $request->visaDetails['nextDestination'];
        $visaNumber = $request->visaDetails['visaNumber'];
        $issuer = $request->visaDetails['issuer'];
        $placeOfIssue = $request->visaDetails['placeOfIssue'];
        $dateOfIssue = $request->visaDetails['dateOfIssue'];
        $dateOfExpiry = $request->visaDetails['dateOfExpiry'];
        $visaType = $request->visaDetails['visaType'];
        $professionArray=[];
        foreach ($request->profession as $pro){
            $profession['professionName']=$pro['professionName'];
            $profession['startDate']=$pro['startDate'];
            $profession['endDate']=$pro['endDate'];
            $profession['description']=$pro['description'];
            array_push($professionArray,$profession);
        }
        $physicalIdentificationMarkArray = [];
        foreach ($request->physicalIdentificationMark as $physical){
            $physicalIdentificationMark['mark']=$physical['mark'];
            array_push($physicalIdentificationMarkArray,$physicalIdentificationMark);
        }
        $profileImage = $request->profileImage;
        $latitude= $request->coordinates['latitude'];
        $longitude= $request->coordinates['longitude'];
        $phoneNumber= $request->phoneNumber;
        $nationality= $request->nationality;
        $body = '{
            "givenName": "'.$givenName.'",
            "middleName": "'.$middleName.'",
            "gender": {
                "genderCode": "'.$genderCode.'"
            },
            "prefix": "'.$prefix.'",
            "phoneExt": "'.$phoneExt.'",
            "email": "'.$email.'",
            "dateOfBirth": "'.$dateOfBirth.'",
            "dobStatus": "'.$dobStatus.'",
            "address": '.json_encode($addressArray).',
            "bloodGroup": "'.$bloodGroup.'",
            "maritalStatus": "'.$maritalStatus.'",
            "relationship": '.json_encode($relationshipArray).',
            "idproof": '.json_encode($idproofArray).',
            "qualification": '.json_encode($qualificationArray).',
            "economicCategory": {
                "categoryCode": "'.$economicCategory.'"
            },
            "visaDetails": {
                "arrivedFrom": "'.$arrivedFrom.'",
                "nextDestination": "'.$nextDestination.'",
                "visaNumber": "'.$visaNumber.'",
                "issuer": "'.$issuer.'",
                "placeOfIssue": "'.$placeOfIssue.'",
                "dateOfIssue": "'.$dateOfIssue.'",
                "dateOfExpiry": "'.$dateOfExpiry.'",
                "visaType": "'.$visaType.'"
            },
            "profession": '.json_encode($professionArray).',
            "physicalIdentificationMark": '.json_encode($physicalIdentificationMarkArray).',
            "profileImage": "'.$profileImage.'",
            "coordinates": {
                "latitude": "'.$latitude.'",
                "longitude": "'.$longitude.'"
            },
            "phoneNumber": "'.$phoneNumber.'",
            "nationality": "'.$nationality.'"
            }';
//        print_r($body);
//        die();

        $userUuid = $request->userUuid;
        try {
            $results = new clientRequest('POST', $baseUrl.'rest/admin/person?userUuid='.$userUuid, $headers, $body);
            $res = $client->sendAsync($results)->wait();
            echo $res->getBody();
        }
        catch (RequestException   $e){
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {
                    echo $e->getMessage();
                }
            }
        }

    }
}
