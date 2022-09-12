@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Linkedin Settings </h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Linkedin Settings Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Linkedin Settings





                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('linkedin.store')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            @if($captcha)
                                            <input type="hidden" name="id" value="{{$captcha->id}}" />
                                            @endif
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> LINKEDIN_CLIENT_ID</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{!isset($captcha)?'':$captcha->LINKEDIN_CLIENT_ID}}" name="LINKEDIN_CLIENT_ID" id="inputName" placeholder="LINKEDIN_CLIENT_ID" autocomplete="tilte">
                                                </div>
                                                @if ($errors->has('LINKEDIN_CLIENT_ID'))
                                                    <span class="text-danger text-left">{{ $errors->first('LINKEDIN_CLIENT_ID') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> LINKEDIN_CLIENT_SECRET</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{!isset($captcha)?'':$captcha->LINKEDIN_CLIENT_SECRET}}" name="LINKEDIN_CLIENT_SECRET" id="slug" placeholder="LINKEDIN_CLIENT_SECRET" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('LINKEDIN_CLIENT_SECRET'))
                                                    <span class="text-danger text-left">{{ $errors->first('LINKEDIN_CLIENT_SECRET') }}</span>
                                                @endif
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">


                                                    @if($captcha)

                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                    @else
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                    @endif
                                                    <button class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection
