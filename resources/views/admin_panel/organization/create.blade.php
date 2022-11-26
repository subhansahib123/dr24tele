@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-5">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Organization</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Organization Details
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('store.organization')}}" method="POST">
                                @csrf
                                <div class=" row mb-1">
                                    <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control " value="{{old('displayname')}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1">
                                    <label for="username" class="col-md-3 form-label"> User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class=" row  mb-1 address">
                                    <label for="email" class="col-md-3 form-label"> Contact Person Designation</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('contactperson')}}" name="contactperson" id="contactperson" placeholder="Contact Person Designation" autocomplete="contactperson">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class="row  mb-1 address">
                                    <div class="col-3 my-0 pt-2">
                                        <label for="exampleInputnumber"><Strong> Contact Number</Strong></label>
                                    </div>
                                    <div class="col-9 my-0 form-group">
                                        <input type="text" id="txtPhone" name="" class="form-control">
                                        <input type="hidden" class="form-control" id="phoneNumber">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="country" class="col-md-3 form-label"> Select Country </label>
                                    <div class="col-md-9">
                                        <input type="hidden" value="" name="country" id="country_value" />
                                        <select class="form-control" onchange="loadStates(this.value,this)" id="country">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}" {{old('country')==$country->name?'selected':''}}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="country" class="col-md-3 form-label"> Select State </label>
                                    <input type="hidden" value="" name="state" id="state_value" />
                                    <div class="col-md-9">
                                        <select class="form-control" onchange="loadCities(this.value,this)" id="state">
                                            <option>Select State</option>

                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="country" class="col-md-3 form-label"> Select City </label>
                                    <input type="hidden" value="" name="city" id="city_value" />
                                    <div class="col-md-9">
                                        <select class="form-control" id="city">
                                            <option>Select City</option>

                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="building" class="col-md-3 form-label">Building</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('building')}}" id="building" name="building" placeholder="Building Address">
                                    </div>
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="district" class="col-md-3 form-label">District</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('district')}}" id="district" name="district" placeholder="District">
                                    </div>
                                </div>
                                <div class=" row  mb-1 address">
                                    <label for="postalCode" class="col-md-3 form-label">Postal Code</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{old('postalCode')}}" id="postalCode" name="postalCode" placeholder="Postal Code">
                                    </div>
                                </div>
                                <div class=" row  mb-1">
                                    <label for="country" class="col-md-3 form-label"> Select Status </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{old("status")=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled    " {{old("status")=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <div class=" row  mb-1">
                                    <label for="image" class="col-md-3 form-label"> Picture </label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image">
                                    </div>
                                </div>

                                <div class=" row  mb-1" id="no-need">
                                    <span id="add"></span>
                                    <label for="level" class="col-md-3 form-label"> Select Level </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="level" id="level">
                                            <option value="Hospital" selected>Hospital</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="mb-0 mt-4 row text-end">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Create</button>

                                        <span><a href="{{route('dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>
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
    var baseUrl = `{{url('/')}}`;
    $('#level').change(function() {
        if ($(this).val() == "Hospital") {
            $('#no-need').hide();
            $('#organization').attr('name', 'org');
            var input_organization = '<input type="hidden" id="input_org" name="input_org" value="c6bc6265-e876-414a-9672-a85e09280059">';
            $('#add').html(input_organization);
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
                option += `<option value='${row.id}'>${row.name}</option>`;
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