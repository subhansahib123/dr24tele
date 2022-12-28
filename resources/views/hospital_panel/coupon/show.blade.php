@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            @include('admin_panel.frontend.includes.messages')

            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Coupons</li>
                                </ol>
                            </div>
                            <div class="col-3">
                                <span class="card-title"><strong>
                                       Coupons List
                                    </strong></span>
                            </div>

                            <div class="col-4 text-end">
                            <a href="{{route('hospital.coupon.create')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>

                                <a href="{{route('hospital.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>

                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <th scope="col">Sr#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Start</th>
                                        <th scope="col">End</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Status</th>
                                    </thead>
                                    @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$coupon->title}}</td>
                                        <td>{{$coupon->start_date}}</td>
                                        <td>{{$coupon->end_date}}</td>
                                        <td>{{$coupon->discount}}</td>
                                        @if($coupon->status == 0)
                                        <td>
                                            <p>Enable</p>
                                        </td>
                                        @else
                                        <td>
                                            <p>Expired</p>
                                        </td>

                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTAINER CLOSED -->

    </div>
</div>


@endsection