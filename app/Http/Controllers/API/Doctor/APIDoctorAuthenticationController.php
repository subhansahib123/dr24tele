<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIDoctorAuthenticationController extends Controller
{
    public function doctorLogin(Request $request)
    {
//         dd($request->all());
        $curl = curl_init();
        $baseUrl = config('services.ehr.baseUrl');
        $apiKey = config('services.ehr.apiKey');
        $phoneNumber = $request->get('phoneNumber');
        $phoneNumber = '+'.$phoneNumber;
        $user = User::with('doctor')->where('phone_number',  $phoneNumber)->first();
        // dd($user);
        if (!isset($user->doctor)){
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "user"=>$user,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'User is not associated with any Department',
                ]
            ]);
        }
        // dd($user->doctor->department);
        $organisation = $user->doctor->department;
        // dd  ($organisation->name);
        if (is_null($organisation))
        {
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [
                    "user"=>$user,
                ],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'No Department record found in database',
                ]
            ]);
        }

        if ($user) {
            Auth::login($user);
            $data = ['username' => $user->username, 'password' => $user->password];
            // dd($user->password);
            $params = array('orgName' => $organisation->name, 'tenantId' => 'ehrn');
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseUrl . 'rest/admin/v1/login?' . http_build_query($params),
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
                    'apikey: ' . $apiKey
                ),
            ));
            try {
                // dd(1);
                $response = curl_exec($curl);
                // dd($response);
                if ($response == false || isset($response->status)) {
                    curl_close($curl);
                    // dd(1);
                    return response()->json([
                        'status' => [
                            'status_code' => 200,
                            'message' => 'Ok'
                        ],
                        'data' => [
                            "CURL"=>curl_error($curl),
                        ],
                        'message' => [
                            "status_code"=> 200,
                            'msg_status' => 'No Department record found in database',
                        ]
                    ]);
                } else {
                    $result_data = json_decode($response);
                    // dd($result_data);
                    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                        curl_close($curl);
                        session_start();
                        session(['loggedInUser' => $result_data]);
                        $userInfo = session('loggedInUser');
                        $userInfo = json_decode(json_encode($userInfo), true);
                        // dd($userInfo);
                        return response()->json([
                            'status' => [
                                'status_code' => 200,
                                'message' => 'Ok'
                            ],
                            'data' => [
                                "user_info"=>$userInfo,
                                "token" => auth()->user()->createToken('API Token')->plainTextToken,
                            ],
                            'message' => [
                                "status_code"=> 200,
                                'msg_status' => 'Successfully Login',
                            ]
                        ]);
                    } else if (isset($result_data->message) && $result_data->message == "API rate limit exceeded") {
                        curl_close($curl);
                        return response()->json([
                            'status' => [
                                'status_code' => 200,
                                'message' => 'Ok'
                            ],
                            'data' => [
                                "error"=> $result_data->message,
                            ],
                            'message' => [
                                "status_code"=> 200,
                                'msg_status' => 'Successfully Login',
                            ]
                        ]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid User") {

                        curl_close($curl);
                        return response()->json([
                            'status' => [
                                'status_code' => 200,
                                'message' => 'Ok'
                            ],
                            'data' => [
                                "error"=>  $result_data->message,
                            ],
                            'message' => [
                                "status_code"=> 200,
                                'msg_status' => 'Successfully Login',
                            ]
                        ]);
                    } else if (isset($result_data->message) && $result_data->message == "Invalid Token") {

                        curl_close($curl);
                        return response()->json([
                            'status' => [
                                'status_code' => 200,
                                'message' => 'Ok'
                            ],
                            'data' => [
                                "error"=>  $result_data->message,
                            ],
                            'message' => [
                                "status_code"=> 200,
                                'msg_status' => 'Successfully Login',
                            ]
                        ]);
                    } else {
                        curl_close($curl);
                        // dd($result_data);
                        return response()->json([
                            'status' => [
                                'status_code' => 200,
                                'message' => 'Ok'
                            ],
                            'data' => [
                                "error"=>  $result_data->message,
                            ],
                            'message' => [
                                "status_code"=> 200,
                                'msg_status' => 'Successfully Login',
                            ]
                        ]);
                    }
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => [
                        'status_code' => 200,
                        'message' => 'Ok'
                    ],
                    'data' => [
                        "error"=>  $e->getMessage(),
                    ],
                    'message' => [
                        "status_code"=> 200,
                        'msg_status' => 'Successfully Login',
                    ]
                ]);
            }
        } else {
            return response()->json([
                'status' => [
                    'status_code' => 200,
                    'message' => 'Ok'
                ],
                'data' => [],
                'message' => [
                    "status_code"=> 200,
                    'msg_status' => 'No User Exist',
                ]
            ]);
        }
    }
}
