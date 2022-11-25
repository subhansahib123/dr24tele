@extends('admin_panel.layout.master')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card  mt-5">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profession List</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong>
                                         Professions List
                                    </strong></span>
                            </div>

                            <div class="col-1">
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('admin_panel.frontend.includes.messages')
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    @foreach($professions as $profession)
                                    <h3>Profession: {{ $profession->profession }}, Number: {{ $profession->number }} </h3>

                                    <table class="table table-striped" id="datatable">


                                        <thead>
                                            <th scope="col-9">Name</th>
                                            <th scope="col">Guard</th>
                                        </thead>

                                        @if($profession->optcrud)
                                        @foreach($profession->optcrud as $opt)


                                        <tr style="line-height: 10px">
                                            <td class="col-9">{{$opt->authCrud}}</td>
                                            <td>{{$opt->opt}}</td>
                                        </tr>
                                        @endforeach
                                        @endif

                                    </table>

                                    @endforeach

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