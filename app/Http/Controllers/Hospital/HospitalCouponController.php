<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Organization;
use Illuminate\Http\Request;
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
