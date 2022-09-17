@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Organization Create</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Organization Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Organization Create




                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('store.organization')}}" method="POST">
                                            @csrf
                                            <div class=" row mb-4">
                                                <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="{{old('displayname')}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                                </div>
                                                @if ($errors->has('displayname'))
                                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> User Name</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="{{old('username')}}" name="username" id="username" placeholder="Username" autocomplete="username">
                                                </div>
                                                @if ($errors->has('username'))
                                                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="email" class="col-md-3 form-label"> Email</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="Email" autocomplete="email">
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="email" class="col-md-3 form-label"> Contact Person Designation</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="{{old('contactperson')}}" name="contactperson" id="contactperson" placeholder="Contact Person Designation" autocomplete="contactperson">
                                                </div>
                                                @if ($errors->has('contactperson'))
                                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" autocomplete="username">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputPassword3" class="col-md-3 form-label">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" autocomplete="new-password">
                                                </div>
                                            </div>
                                           <div class="mb-0 row justify-content-end">
                                                <div class="col-md-9">
                                                    <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                                                            <span class="custom-control-label">Check me Out</span>
                                                        </label>
                                                </div>
                                            </div>
                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button class="btn btn-primary" type="submit">Save</button>
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
@section('foot_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked',true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked',false);
                });
            }

        });
    });
</script>
@endsection
