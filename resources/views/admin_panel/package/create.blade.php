@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Package Create</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Package Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        @include('admin_panel.frontend.includes.messages')

                        <div class="row">

                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Package Create
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('packeges.store')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Title</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{old('title')}}" name="title" id="inputName" placeholder="Title" autocomplete="tilte">
                                                </div>
                                                @if ($errors->has('title'))
                                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                            {{-- <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Slug</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{old('slug')}}" name="slug" id="slug" placeholder="Slug" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('slug'))
                                                    <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                                                @endif
                                            </div> --}}
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Package Type</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{old('package_type')}}" name="package_type" id="package_type" placeholder="Enter Package Type" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('package_type'))
                                                    <span class="text-danger text-left">{{ $errors->first('package_type') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Recommended </label>
                                                <div class="col-md-9">
                                                    <select name="recomended" class="form-control" id="recomended">
                                                      <option value="1" selected>Yes</option>
                                                      <option value="0" >No</option>
                                                    </select>
                                               </div>
                                                @if ($errors->has('recomended'))
                                                    <span class="text-danger text-left">{{ $errors->first('recomended') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Price</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" value="{{old('price')}}" name="price" id="slug" placeholder="Enter Price" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('price'))
                                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label">Saving Price</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" value="{{old('saving_price')}}" name="saving_price" id="slug" placeholder="Enter Saving Price" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('saving_price'))
                                                    <span class="text-danger text-left">{{ $errors->first('saving_price') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Included Api </label>
                                                <div class="col-md-9">
                                                     <select name="include_api" class="form-control" id="include_api">
                                                       <option value="1" selected>Yes</option>
                                                       <option value="0" >No</option>
                                                     </select>
                                                </div>
                                                @if ($errors->has('include_api'))
                                                    <span class="text-danger text-left">{{ $errors->first('include_api') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Included plugins  </label>
                                                <div class="col-md-9">
                                                     <select name="include_plugins" class="form-control" id="include_plugins">
                                                       <option value="1" selected>Yes</option>
                                                       <option value="0" >No</option>
                                                     </select>
                                                </div>
                                                @if ($errors->has('include_plugins'))
                                                    <span class="text-danger text-left">{{ $errors->first('include_plugins') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Package Validity  </label>
                                                <div class="col-md-9">
                                                     <select name="package_validity" class="form-control" id="package_validity">
                                                       <option value="1" selected>01 Month</option>
                                                       <option value="2" >02 Months</option>
                                                       <option value="6" >06 Months</option>
                                                       <option value="12" >12 Months</option>
                                                     </select>
                                                </div>
                                                @if ($errors->has('package_validity'))
                                                    <span class="text-danger text-left">{{ $errors->first('package_validity') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> User Seats  </label>
                                                <div class="col-md-9">
                                                     <select name="user_seats" class="form-control" id="user_seats">
                                                       <option value="0" selected>0</option>
                                                       <option value="1" >1</option>
                                                       <option value="2" >2</option>
                                                       <option value="3" >3</option>
                                                       <option value="4" >4</option>
                                                       <option value="5" >5</option>
                                                       <option value="5" >5</option>
                                                       <option value="7" >7</option>
                                                       <option value="8" >8</option>
                                                       <option value="9" >9</option>
                                                       <option value="10" >10</option>
                                                       <option value="11" >11</option>
                                                       <option value="12" >12</option>
                                                     </select>
                                                </div>
                                                @if ($errors->has('user_seats'))
                                                    <span class="text-danger text-left">{{ $errors->first('user_seats') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Description</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" class="form-control ck" value="" name="des" >
                                                        {{old('des')}}
                                                    </textarea>
                                                </div>
                                                @if ($errors->has('des'))
                                                    <span class="text-danger text-left">{{ $errors->first('des') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" required class="form-control" value="{{old('image')}}" name="image" >
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>


                                            <div class="mb-0 row justify-content-end">
                                                <div class="col-md-9">
                                                    <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="status" >
                                                            <span class="custom-control-label">Status</span>
                                                        </label>
                                                </div>
                                            </div>
                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                    {{-- <button class="btn btn-secondary">Cancel</button> --}}
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
