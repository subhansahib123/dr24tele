@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-5">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row mt-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Hospital</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong>Hospital Details </strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('hospitalUpdated')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class=" row mb-1">

                                    <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->displayname}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>
                                <input type="hidden" class="form-control" value="{{$organization->uuid}}" name="OrgUuid" id="OrgUuid" placeholder="Display Name" autocomplete="OrgUuid">

                                <div class=" row mb-1" style="display:none">
                                    <label for="username" class="col-md-3 form-label"> User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->name}}" name="name" id="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class=" row mb-1">
                                    <label for="email" class="col-md-3 form-label"> Contact Person Designation</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->contactperson_designation}}" name="contactperson_designation" id="contactperson_designation" placeholder="Contact Person Designation" autocomplete="contactperson_designation">
                                    </div>
                                    @if ($errors->has('contactperson_designation'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson_designation') }}</span>
                                    @endif
                                </div>
                                <div class="row my-0 addresss">
                                    <div class="col-3 my-0 pt-2">
                                        <label for="exampleInputnumber"><Strong> Contact Number</Strong></label>
                                    </div>
                                    <div class="col-9 my-0 form-group">
                                        <input type="text" id="txtPhone" name="contactperson" class="form-control" value="{{$organization->contactperson}}">
                                        <input type="hidden" class="form-control" id="phoneNumber">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-1">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" value="{{$organization->email}}" name="email" placeholder="Email" autocomplete="username">
                                    </div>
                                </div>

                                <div class=" row mb-1 addresss">
                                    <label for="building" class="col-md-3 form-label">Building</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->building}}" id="building" name="building" placeholder="Building Address">
                                    </div>
                                </div>
                                <div class=" row mb-1 addresss">
                                    <label for="district" class="col-md-3 form-label">District</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->district}}" id="district" name="district" placeholder="District">
                                    </div>
                                </div>
                                <div class=" row mb-1 addresss">
                                    <label for="postalCode" class="col-md-3 form-label">Postal Code</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{$organization->postalCode}}" id="postalCode" name="postalCode" placeholder="Postal Code">
                                    </div>
                                </div>
                                <div class=" row mb-1">
                                    <label for="country" class="col-md-3 form-label"> Select Status </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{$organization->status=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled    " {{$organization->status=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <div class=" row  mb-1">
                                    <label for="image" class="col-md-3 form-label"> Picture </label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image">
                                    </div>
                                </div>
                                <div class="mx-0 px-0 mt-4 row card-footer text-end">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                        <span><a href="{{route('hospital.dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>

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
    var state = `{{$organization->state}}`;
    var city = `{{$organization->city}}`;
    var baseUrl = `{{url('/')}}`;
    $('#level').change(function() {
        if ($(this).val() == "Hospital") {
            $('.addresss').show();
            $('#no-need').hide();
            $('#organization').attr('name', 'org');
            var input_organization = '<input type="hidden" id="input_org" name="organization" value="c6bc6265-e876-414a-9672-a85e09280059">';
            $('#add').html(input_organization);
            return false;
        } else if ($(this).val() == "Department") {
            $('.addresss').hide();
            $('#add').html('');
            $('#no-need').show();
            $('#organization').attr('name', 'organization');
            return false;
        }

    });

    function loadStates(country_id, context) {

        if (country_id == '')
            return false;

        // console.log($(this))
        var country_name = $(context).find(':selected').text();
        $('#country_value').val(country_name);
        $.ajax({
            url: `${baseUrl}/api/states/${country_id}`,
            method: 'GET'
        }).done(function(data) {
            // console.log(data);
            var option = "<option value=''>Select State</option>";
            data.forEach(function(row, index) {
                console.log(row);
                if (state == row.name)
                    option += `<option value='${row.id}' selected>${row.name}</option>`;
                else
                    option += `<option value='${row.id}' >${row.name}</option>`;
            });
            $('#state').html(option);
        }).fail(function(error) {
            console.log(error);
        });
    }

    function loadCities(state_id, context) {
        if (state_id == '')
            return false;
        var state = $(context).find(':selected').text();
        $('#state_value').val(state);
        $.ajax({
            url: `${baseUrl}/api/cities/${state_id}`,
            method: 'GET'
        }).done(function(data) {
            // console.log(data);
            var option = "<option value=''>Select City</option>";
            data.forEach(function(row, index) {
                // console.log(row);
                if (city == row.name)
                    option += `<option value='${row.id}' selected>${row.name}</option>`;
                else
                    option += `<option value='${row.id}'>${row.name}</option>`;
            });
            $('#city').html(option);
        }).fail(function(error) {
            console.log(error);
        });
    }

    $(document).ready(function() {
        $('#city').change(function() {
            let city = $(this).find(':selected').text();
            $('#city_value').val(city);
        });
    });
</script>
@endsection
