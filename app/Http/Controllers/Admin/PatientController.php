<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\UsersOrganization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PatientController extends Controller
{
    public function patient(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'image' => 'required',
        ]);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        if ($request->hasFile('image')) {
            $getImage = date('Y') . '/' . time() . '-' . rand(0, 999999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/organization/') . date('Y'), $getImage);
            $image = $getImage;
        } else {
            $image = '';
        }
        // dd($image);
        try {
            $UserData = User::firstOrCreate([
                'username' => $request->username,
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'uuid' => Str::uuid(),
                'PersonId' => Str::uuid(),
                'status' => 1,
                'image' => $image

            ]);

            // dd($UserData);
            return $this->storePatients($UserData);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function createPatients()
    {
        $users = User::all();
        return view('admin_panel.patients.create', ['users' => $users]);
    }
    public function storePatients($UserData)
    {

        // dd($UserData->uuid);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {

            $user = User::where('uuid', $UserData->uuid)->first();

            $user->update([
                'PersonUuid' => Str::uuid(),
            ]);

            // dd($user);
            return $this->mapPatients($user);
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function mapPatients($user)
    {
        // dd(1);
        $organizations = Organization::all();
        return view('admin_panel.patients.mapPatients', ['user' => $user, 'organizations' => $organizations]);
    }
    public function     patientMapped(Request $request)
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        $user = User::with('patient')->where('id', $request->userId)->first();
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {

            $org = Organization::where('uuid', $request->organisation)->first();
            // dd($request->userId,$org->id);
            Patient::firstOrCreate([
                'user_id' => $request->userId,
                'organization_id' => $org->id,
                'status' => 1,
                'image' => 1
            ]);

            UsersOrganization::firstOrCreate([

                'status' => 1,
                'registration_code' => '123ABC',
                'user_id' => $request->userId,
                'organization_id' => $org->id
            ]);

            return redirect()->route('create.patients')->withSuccess(__('Patient Successfully Created'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function patientsList($uuid)
    {
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        try {
            $org = Organization::where('uuid', $uuid)->first();
            $patients = Patient::with('user')->where('organization_id', $org->id)->get();

            // dd ($patients->user->name );
            return view('admin_panel.patients.showPatients', ['patients' => $patients]);
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
    public function patientDelete($uuid)
    {


        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        // dd($userInfo);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }

        try {


            $user = User::where('uuid', $uuid)->first();
            if ($user) {
                UsersOrganization::where('user_id', $user->id)->delete();
                Patient::where('user_id', $user->id)->delete();
                $user->delete();
            }
            return redirect()->back()->withSuccess(__('Successfully Patient Deleted'));
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
   

    public function   patientUpdated(Request $request)
    {
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
        $token = $userInfo['sessionInfo']['token'];
        $req_url = $baseUrl . 'rest/admin/person/' . $request->personId;

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
        // dd($data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $req_url,
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
                'apikey: ' . $apiKey
            ),
        ));


        try {
            $response = curl_exec($curl);
            // dd($response);

            if ($response == false) {

                $error = curl_error($curl);
                curl_close($curl);

                return redirect()->back()->withErrors(['error' => $error]);
            } else {
                $patient = json_decode($response);
                // dd($userName->username);
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                    curl_close($curl);
                    $user = User::where('personId', $request->personId)->first();
                    $user->update([
                        'email' => $request->email,
                        'password' => $request->password,
                        'phone_number' => $request->phoneNumber,
                    ]);

                    return redirect()->back()->withSuccess(__('Patient Successfully Updated'));
                } else if (isset($patient->message) && $patient->message == "API rate limit exceeded") {
                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patient->message]);
                } else if (isset($patient->message) && $patient->message == "Invalid User") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patient->message]);
                } else if (isset($patient->message) && $patient->message == "Invalid Token") {

                    curl_close($curl);
                    return redirect()->route('logout')->withErrors(['error' => $patient->message]);
                } else {
                    curl_close($curl);
                    return redirect()->back()->withErrors(['error' => $patient->message]);
                }
            }
        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => __($e->getMessage())]);
        }
    }
}
