<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Coupon;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\UsersOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HospitalCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('hospital_panel.coupon.show', compact('coupons', $coupons));
    }

    public function assignUser(){
        $coupons = Coupon::all();
        $users_orgnization = UsersOrganization::where('user_id','=',Auth::user()->id)->first();
        $patients = Patient::with('user')->where('organization_id','=',$users_orgnization->organization_id)->get();
        return view('hospital_panel.coupon.assign', compact('coupons','patients'));
    }

    public function assignUserPost(Request $request) {
        $validated = $request->validate([
            'coupon' => 'required',
            'patients' => 'required',
        ]);
        $results = $request->all();
        if(count($results['patients'])> 0){
            SendEmailJob::dispatch($results);
        }
        return redirect()->back()->with(['success'=>'Mail Send Successfully!!']);


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospital = Organization::all();
        return view('hospital_panel.coupon.create', compact('hospital',$hospital));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(['title' => 'required|string']);
        $userInfo = session('loggedInUser');
        $userInfo = json_decode(json_encode($userInfo), true);
        if (is_null($userInfo)) {

            return redirect()->route('patient.login')->withErrors(['error' => 'Token Expired Please Login Again !']);
        }
         $coupon = Coupon::create(['title'=> $request->title, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
             'uuid'=> Str::uuid()->toString(),'status'=>$request->status, 'organization_id' => $request->hospital, 'discount' => $request->discount,
             'created_by' => $userInfo['sessionInfo']['id']]);
        if($coupon) {
            return redirect()->back()->withSuccess(__('Coupon is Successfully Created'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    public function applyCoupon(Request $request)
    {
        dd($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
