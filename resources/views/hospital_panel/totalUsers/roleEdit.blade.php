@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map User by Role </h1>
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
                <div class="form-group">
                    <label for="user">User</label>
                    <select class="form-control" value="{{old('user')}}" name="user" id="user">
                <option value="">select</option>
                       
                    @if($users)
                        @foreach ($users as $user)
                        <option value="{{$user->uuid}}">{{$user->username}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="organizations">Organization</label>
                    <select class="form-control"   name="organizations" id="organization">
                        @if($organizations)
                        @foreach ($organizations as $organization)
                        <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                @endforeach
                @endif
                </select>
        </div>
        <div class="form-group">
            <label for="organizations">Departments</label>
            <select class="form-control" name="department" id="departments">
                <option value='' selected>Select Department</option>
            </select>
        </div>--}}
        <div class="form-group">
            <label for="organizations">Map In Organisation

                <input type="checkbox" id="onlyinOrg" />
            </label>



        </div>
        <input type="hidden" value="{{$org->id}}" name="org">

        <div class="form-group" id="dep">
            <label for="department">Departments</label>
            <select class="form-control" value="{{old('department')}}" name="department" id="department">
                <option value="">select</option>

                @if($departments)
                @foreach ($departments as $department)
                <option value="{{$department->uuid}}">{{$department->name}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="role">Roles</label>
            <select class="form-control" value="{{old('role')}}" name="role" id="role">
            <option value="">select</option>
                @if($roles)
                @foreach ($roles as $role)
                <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
                @endif
            </select>
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
            $('#dep').hide();
        } else {
            $('#dep').show();
        }
    });
</script>
@endsection