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
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a> </li>
                                        <li class="breadcrumb-item active" aria-current="page">Create  Hospital </li>
                                    </ol>
                                </div>
                                <div class="col-4">
                                <span class="card-title"><strong>
                                         Hospital Details
                                    </strong></span>
                                </div>

                                <div class="col-3 text-end">
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" enctype="multipart/form-data"
                                      action="{{route('store.organization')}}" method="POST">
                                    @csrf
                                    <div class=" row mb-1">
                                        <label for="displayname" class="col-md-3 form-label"> Display Name *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control " onkeydown="return /[a-z]/i.test(event.key)" value="{{old('displayname')}}"
                                                   name="displayname" id="displayname" placeholder="Display Name"
                                                   autocomplete="displayname">
                                        </div>
                                        @if ($errors->has('displayname'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1">
                                        <label for="username" class="col-md-3 form-label"> User Name *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" onkeydown="return /[a-z\_]/i.test(event.key)" value="{{old('name')}}" name="name"
                                                   id="username" placeholder="Username">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class=" row  mb-1 address">
                                        <label for="email" class="col-md-3 form-label"> Contact Person
                                            Designation </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                   value="{{old('contactperson_designation')}}"
                                                   name="contactperson_designation" id="contactperson_designation"
                                                   placeholder="Contact Person Designation"
                                                   autocomplete="contactperson_designation" 
                                                   onkeydown="return /[a-z]/i.test(event.key)">
                                        </div>
                                        @if ($errors->has('contactperson_designation'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('contactperson_designation') }}</span>
                                        @endif
                                    </div>
                                    <div class="row  mb-1 address">
                                        <div class="col-3 my-0 pt-2">
                                            <label for="exampleInputnumber"><Strong> Contact Number</Strong> *</label>
                                        </div>
                                        <div class="col-9 my-0 form-group">
                                            <input type="text" id="txtPhone" name="contactperson" onkeydown="return /[0-9]/i.test(event.key)" class="form-control">
                                            <input type="hidden" class="form-control" id="phoneNumber">
                                        </div>
                                        @if ($errors->has('contactperson'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="country" class="col-md-3 form-label"> Select Country  *</label>
                                        <div class="col-md-9">
                                            <input type="hidden" value="" name="country" id="country_value"/>
                                            <select class="form-control" onchange="loadStates(this.value,this)"
                                                    id="country">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option
                                                        value="{{$country->id}}" {{old('country')==$country->name?'selected':''}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="country" class="col-md-3 form-label"> Select State  *</label>
                                        <input type="hidden" value="" name="state" id="state_value"/>
                                        <div class="col-md-9">
                                            <select class="form-control" onchange="loadCities(this.value,this)"
                                                    name="state" id="state">
                                                <option>Select State</option>

                                            </select>
                                        </div>
                                        @if ($errors->has('state'))
                                            <span class="text-danger text-left">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="country" class="col-md-3 form-label"> Select City  *</label>
                                        <input type="hidden" value="" name="city" id="city_value"/>
                                        <div class="col-md-9">
                                            <select class="form-control" id="city" name="city">
                                                <option>Select City</option>

                                            </select>
                                        </div>
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1">
                                        <label for="inputEmail3" class="col-md-3 form-label">Email *</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" value="{{old('email')}}"
                                                   name="email" placeholder="Email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="building" class="col-md-3 form-label">Building </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{old('building')}}"
                                                   id="building" name="building" placeholder="Building Address">
                                        </div>
                                        @if ($errors->has('building'))
                                            <span class="text-danger text-left">{{ $errors->first('building') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="district" class="col-md-3 form-label">District </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{old('district')}}"
                                                   id="district" name="district" placeholder="District">
                                        </div>
                                        @if ($errors->has('district'))
                                            <span class="text-danger text-left">{{ $errors->first('district') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1 address">
                                        <label for="postalCode" class="col-md-3 form-label">Postal Code </label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" onkeydown="return /[a-z,0-9]/i.test(event.key)" value="{{old('postalCode')}}"
                                                   id="postalCode" name="postalCode" placeholder="Postal Code">
                                        </div>
                                        @if ($errors->has('postalCode'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('postalCode') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1">
                                        <label for="country" class="col-md-3 form-label"> Select Status  *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="status" id="state">
                                                <option value="">Select</option>
                                                <option value="Enabled" {{old("status")=="Enabled"?"selected":''}}>
                                                    Enable
                                                </option>
                                                <option value="Disabled" {{old("status")=="Disabled"?"selected":''}}>
                                                    Disable
                                                </option>
                                            </select>
                                        </div>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                    <div class=" row  mb-1">
                                        <label for="image" class="col-md-3 form-label"> Picture <strong> 1140*650</strong>  *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="file" name="image" id="image">
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class=" row  mb-1" id="no-need">
                                        <span id="add"></span>
                                        <label for="level" class="col-md-3 form-label"> Select Level  *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="level" id="level">
                                                <option value="Hospital" selected>Hospital</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('level'))
                                            <span class="text-danger text-left">{{ $errors->first('level') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-0 mt-4 row text-end">
                                        <div class="col">
                                            <button class="btn btn-primary" type="submit">Create</button>
                                            <span><a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a></span>
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
        $('#level').change(function () {
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
            }).done(function (data) {
                // console.log(data);
                var option = "<option value=''>Select State</option>";
                data.forEach(function (row, index) {
                    console.log(row);
                    option += `<option value='${row.id}'>${row.name}</option>`;
                });
                $('#state').html(option);
            }).fail(function (error) {
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
            }).done(function (data) {
                // console.log(data);
                var option = "<option value=''>Select City</option>";
                data.forEach(function (row, index) {
                    // console.log(row);
                    option += `<option value='${row.id}'>${row.name}</option>`;
                });
                $('#city').html(option);
            }).fail(function (error) {
                console.log(error);
            });
        }

        $(document).ready(function () {
            $('#city').change(function () {
                let city = $(this).find(':selected').text();
                $('#city_value').val(city);
            });
        });
    </script>
@endsection
