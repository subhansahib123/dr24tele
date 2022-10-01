@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Update Organization</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Organization</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=""> Update Organization
                            </h4>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('update.organization')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">

                                    <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->displayname}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>
                                <input type="hidden" class="form-control" value="{{$organization->uuid}}" name="OrgUuid" id="OrgUuid" placeholder="Display Name" autocomplete="OrgUuid">

                                <div class=" row mb-4">
                                    <label for="username" class="col-md-3 form-label"> User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$orgData->name}}" name="name" id="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class=" row mb-4">
                                    <label for="email" class="col-md-3 form-label"> Contact Person Designation</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->contactperson}}" name="contactperson" id="contactperson" placeholder="Contact Person Designation" autocomplete="contactperson">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="phone" class="col-md-3 form-label"> Phone Number</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{$organization->phone}}" name="phone" id="phone" placeholder="Phone Number" autocomplete="contactperson">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4 addresss">
                                    <label for="country" class="col-md-3 form-label"> Select Country </label>
                                    <div class="col-md-9">
                                        <input type="hidden" value="" name="country" id="country_value" />
                                        <select class="form-control" onchange="loadStates(this.value,this)" id="country">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}" {{$organization->address[0]->country==$country->name?'selected':''}}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4 addresss">
                                    <label for="country" class="col-md-3 form-label"> Select State </label>
                                    <input type="hidden" value="" name="state" id="state_value" />
                                    <div class="col-md-9">
                                        <select class="form-control" onchange="loadCities(this.value,this)" id="state">
                                            <option >Select State</option>

                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4 addresss">
                                    <label for="country" class="col-md-3 form-label"> Select City </label>
                                    <input type="hidden" value="" name="city" id="city_value" />
                                    <div class="col-md-9">
                                        <select class="form-control" id="city">
                                            <option >Select City</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div> 
                                <div class=" row mb-4">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" value="{{$organization->email}}" name="email" placeholder="Email" autocomplete="username">
                                    </div>
                                </div>
                                
                                <div class=" row mb-4 addresss">
                                    <label for="building" class="col-md-3 form-label">Building</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->address[0]->building}}" id="building" name="building" placeholder="Building Address">
                                    </div>
                                </div>
                                <div class=" row mb-4 addresss">
                                    <label for="district" class="col-md-3 form-label">District</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$organization->address[0]->district}}" id="district" name="district" placeholder="District">
                                    </div>
                                </div>
                                <div class=" row mb-4 addresss">
                                    <label for="postalCode" class="col-md-3 form-label">Postal Code</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{$organization->address[0]->postalCode}}" id="postalCode" name="postalCode" placeholder="Postal Code">
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="country" class="col-md-3 form-label"> Select Status </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{$organization->status=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled    " {{$organization->status=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0 mt-4 row justify-content-end">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{route('dashboard')}}"><button class="btn btn-secondary mt-3">Cancel</button></a>

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
    var state=`{{$organization->address[0]->state}}`;
    var city=`{{$organization->address[0]->city}}`;
    var baseUrl = `{{url('/')}}`;
    $('#level').change(function(){
        if($(this).val()=="Hospital"){
            $('.addresss').show();
            $('#no-need').hide();
            $('#organization').attr('name','org');
            var input_organization='<input type="hidden" id="input_org" name="organization" value="c6bc6265-e876-414a-9672-a85e09280059">';
            $('#add').html(input_organization);
            return false;
        }else if($(this).val()=="Department"){
            $('.addresss').hide();
            $('#add').html('');
            $('#no-need').show();
            $('#organization').attr('name','organization');
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
                if(state==row.name)
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
                if(city==row.name)
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
