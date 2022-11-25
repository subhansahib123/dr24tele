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
                                    <li class="breadcrumb-item active" aria-current="page">Management</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Mapping Management</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form action="{{route('role.mapped')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1">
                                        <label for="user">User</label>
                                        <input class="form-control" type="text" disabled value="{{$user->username}}">
                                        <input type="hidden" disabled value="{{$user->uuid}}" name="user" id="user">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1">
                                        <label for="organizations">Organisation</label>
                                        <select class="form-control" name="organizations" id="organization">
                                            @if($organizations)
                                            @foreach ($organizations as $organization)
                                            <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1">
                                        <label for="role">Roles</label>
                                        <select class="form-control" value="{{old('role')}}" name="role" id="role">
                                            @if($roles)
                                            @foreach ($roles as $role)
                                            @if($role->name=='Practitioner')
                                            <option style="display:none" value=""></option>
                                            @elseif($role->name!='Practitioner')
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1" id="depart_p">
                                        <label for="organizations">Departments</label>
                                        <select class="form-control" name="department" id="departments">
                                            <option value='' selected>Select Department</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 my-3">
                                        <label for="organizations">Map In Organisation

                                            <input type="checkbox" id="onlyinOrg" />
                                        </label>

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