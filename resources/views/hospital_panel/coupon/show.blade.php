@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Coupon List</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupons List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-3"><span class="card-title">List</span></div>
                            <div class="col-7 align-self-center"></div>



                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">






                                    <h3></h3>

                                    <table class="table table-striped">
                                        <thead>
`                                            <th scope="col" width="20%">Title</th>
                                             <th scope="col" width="10%">Start</th>
                                             <th scope="col" width="10%">End</th>
                                             <th scope="col" width="10%">Discount</th>
                                             <th scope="col" width="10%">Status</th>
                                        </thead>


                                        @foreach($coupons as $coupon)
                                        <tr>
                                            <td>
                                                {{$coupon->title}}
                                            </td>
                                            <td>
                                                {{ $coupon->start_date }}
                                            </td>
                                            <td>
                                                {{ $coupon->end_date }}
                                            </td>
                                            <td>
                                                {{ $coupon->discount }}
                                            </td>
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
                                <div class="mt-4">
                                    <!-- <a href="" class="btn btn-info">Edit</a> -->
                                    <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>

                                </div>
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
