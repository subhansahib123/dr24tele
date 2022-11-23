@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"> Management Roles </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map User </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('hospitalUser.mapped')}}" method="POST">
                @csrf
                <div class="row">
                <input type="hidden" value="{{$user->uuid}}" name="user" id="user" >

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="role">Roles</label>
                            <select class="form-control" value="{{old('role')}}" name="role" id="role">
                                <option value="">select</option>
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
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group" id="dep">
                            <label for="department">Departments</label>
                            <select class="form-control" value="{{old('department')}}" name="department" id="department">
                                <option value="">select</option>
                                @if($departments)
                                @foreach ($departments as $department)
                                <option  value="{{$department->uuid}}">{{$department->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-5 mt-2 col-sm-12">
                        <div class="form-group mb-3">
                            <label for="organizations">Map In Organisation

                                <input type="checkbox" id="onlyinOrg" />
                            </label>



                        </div>
                    </div>
                    
                </div>






                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Map User Role</button>


                    <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



{{--
<!--
@section('foot_script')
 <script>
    var base_url=`{{url('/')}}`;
$('#organization').change(function(){
var uuid=$(this).val();
var url=`${base_url}/api/getDepartments/${uuid}`;
$.ajax({
type:'GET',
url:url
}).done(function(data){
if(data){
var option="<option value='' selected>Select Department</option>";
data.forEach(function(row,index){
// console.log(row,index);
option+=`<option value='${row.uuid}'>${row.name}</option>`;
});
$('#departments').html(option);
}

}).fail(function(error){
console.log(error);
});
});
</script> -->--}}

@endsection

@section('foot_script')
<script>
    $('#onlyinOrg').change(function() {
        if ($(this).is(':checked')) {
            $('#dep').val("null").hide();
            $('#department').val("null");
            
        } else {
            $('#dep').show();
        }
    });
</script>
@endsection