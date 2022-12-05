@extends('hospital_panel.layout.master');

@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Hospital Coupons</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Send Coupon 
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">

                            </div>
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <form class="form-horizontal" action="{{route('hospital.coupon.assigncoupon')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <label for="coupon" class="col-md-3 form-label">Coupon</label>
                                    <div class="col-md-9">
                                        <select class="select-coupon" name="coupon" style="width: 100%">
                                            @foreach($coupons as $coupon)
                                            <option value="{{ $coupon->id }}">{{ $coupon->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('coupon'))
                                    <span class="text-danger text-left">{{ $errors->first('coupon') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="patients" class="col-md-3 form-label">Patients</label>
                                    <div class="col-md-9">
                                        <select class="select-patient" name="patients[]" style="width: 100%" multiple="multiple">
                                            @foreach($patients as $patient)
                                            <option value="{{ $patient->user_id }}">{{ $patient->user->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('patients'))
                                    <span class="text-danger text-left">{{ $errors->first('patients') }}</span>
                                    @endif
                                </div>
                                <div class="px-0; card-footer text-end">
                                    <div >
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection