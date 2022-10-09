@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Captch Settings </h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Captch Settings Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Captch Settings




                                           
                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('captcha.store')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            @if($captcha)
                                            <input type="hidden" name="id" value="{{$captcha->id}}" />
                                            @endif
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> GOOGLE_RECAPTCHA_KEY</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{!isset($captcha)?'':$captcha->GOOGLE_RECAPTCHA_KEY}}" name="GOOGLE_RECAPTCHA_KEY" id="inputName" placeholder="GOOGLE_RECAPTCHA_KEY" autocomplete="tilte">
                                                </div>
                                                @if ($errors->has('GOOGLE_RECAPTCHA_KEY'))
                                                    <span class="text-danger text-left">{{ $errors->first('GOOGLE_RECAPTCHA_KEY') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> GOOGLE_RECAPTCHA_SECRET</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{!isset($captcha)?'':$captcha->GOOGLE_RECAPTCHA_SECRET}}" name="GOOGLE_RECAPTCHA_SECRET" id="slug" placeholder="GOOGLE_RECAPTCHA_SECRET" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('GOOGLE_RECAPTCHA_SECRET'))
                                                    <span class="text-danger text-left">{{ $errors->first('GOOGLE_RECAPTCHA_SECRET') }}</span>
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
