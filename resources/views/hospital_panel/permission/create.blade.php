@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Permission Create</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Permission Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Permission Create




                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('permissions.store')}}" method="POST">
                                            @csrf
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="inputName" placeholder="Name" autocomplete="username">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            {{-- <div class=" row mb-4">
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
                                            </div> --}}
                                            {{-- <div class="mb-0 row justify-content-end">
                                                <div class="col-md-9">
                                                    <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                                                            <span class="custom-control-label">Check me Out</span>
                                                        </label>
                                                </div>
                                            </div> --}}
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
