@extends('admin_panel.layout.master');

@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Setting</h1>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="row">
                                <div class="col-md-3 p-3 px-3 text-center"><span class="card-title">Setting</span></div>

                            </div>
                        </div>
                        <div class="card-body">

                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <span>{{ $message }}</span>
                            </div>
                            @endif
                            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')   
                           
                            <input type="hidden" name="id" value="{{isset($setting)?$setting->id:''}}" />
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Address :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$setting->address}}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Main Logo :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="image" value="{{$setting->image}}" />
                                         <img src="{{isset($setting)?asset('assets/images/users/'.$setting->image):''}}" width="50px">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sidebar logo:</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="logosidebar" value="{{$setting->logosidebar}}" />
                                        <img src="{{isset($setting)?asset('assets/images/users/'.$setting->logosidebar):''}}" width="50px">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Email-1 :</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email1" value="{{$setting->email1}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Email-2 :</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email2" value="{{$setting->email2}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Phone-1 :</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="phone1" value="{{$setting->phone1}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Phone-2 :</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="phone2" value="{{$setting->phone2}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Favicon :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="favicon" value="{{$setting->favicon}}" /> 
                                        <img src="{{isset($setting)?asset('assets/images/users/'.$setting->favicon):''}}" width="50px">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Copyright :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="copyright" value="{{$detail->copyright}}">
                                    </div>
                                </div>
                              @if(isset($setting))
                              <button type="submit">update</button>
                              @else
                              <button type="submit">save</button>
                              @endif
                               
                                <!-- <a class="btn btn-sm btn-primary badge" href="{{ route('setting.edit', $detail->id) }}">Edit Setting</a> -->
                              
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW END -->

    </div>
    <!-- CONTAINER END -->
</div>
</div>

@endsection