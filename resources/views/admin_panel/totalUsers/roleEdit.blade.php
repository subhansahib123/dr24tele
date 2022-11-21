@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map User by Role Under Organization </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map User </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('role.mapped')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="user">User</label>
                        <select class="form-control" value="{{old('user')}}" name="user" id="user">
                            @if($users)
                            @foreach ($users as $user)
                            <option value="{{$user->uuid}}">{{$user->username}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="organizations">Organisation</label>
                        <select class="form-control" name="organizations" id="organization">
                            @if($organizations)
                            @foreach ($organizations as $organization)
                            <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="role">Roles</label>
                        <select class="form-control" value="{{old('role')}}" name="role" id="role">
                            @if($roles)
                            @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="organizations">Map In Organisation

                            <input type="checkbox" id="onlyinOrg" />
                        </label>

                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12" id="depart_p">
                        <label for="organizations">Departments</label>
                        <select class="form-control" name="department" id="departments">
                            <option value='' selected>Select Department</option>
                        </select>
                    </div>
                    
                </div>

                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Map</button>


                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection

@section('foot_script')
<script>
    $('#onlyinOrg').change(function() {
        if ($(this).is(':checked')) {
            $('#depart_p').hide();
        } else {
            $('#depart_p').show();
        }
    });
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