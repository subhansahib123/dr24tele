@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Doctor</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Doctor Mapping</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('doctorMapped')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$userUuid}}" name="user">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <label for="organization">Organisation</label>
                                        <select class="form-control" name="organization" id="organization">
                                            @if($organizations)
                                            @foreach ($organizations as $organization)
                                            <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('organization'))
                                        <span class="text-danger text-left">{{ $errors->first('organization') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12" id="depart_p">
                                        <label for="departments">Departments</label>
                                        <select class="form-control" name="department" id="departments">
                                            <option value='' selected>Select Department</option>
                                        </select>
                                        @if ($errors->has('departments'))
                                        <span class="text-danger text-left">{{ $errors->first('departments') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary">Map</button>


                                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

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
<script>
    var base_url = `{{url('/')}}`;
    $('#organization').change(function() {
        var uuid = $(this).val();
        var url = `${base_url}/api/getDepartments/${uuid}`;
        $.ajax({
            type: 'GET',
            url: url
        }).done(function(data) {
            if (data) {
                var option = "<option value='' selected>Select Department</option>";
                data.forEach(function(row, index) {
                    // console.log(row,index);
                    option += `<option value='${row.uuid}'>${row.name}</option>`;
                });
                $('#departments').html(option);
            }
        }).fail(function(error) {
            console.log(error);
        });
    });
</script>

@endsection