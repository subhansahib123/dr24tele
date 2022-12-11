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
        $userInfo = session('loggedInUser');
        // dd(session());
        if (!empty($userInfo)) {
            $userInfo = json_decode(json_encode($userInfo), true);
            $token = $userInfo['uuid'];

            try {
                $professions = Profession::orderBy('id','desc')->get();
                return  view('admin_panel.profession.show', ["professions" => $professions]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => __($e->getMessage())]);

            }
        } else {

            return redirect()->route('logout')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
    }
}
