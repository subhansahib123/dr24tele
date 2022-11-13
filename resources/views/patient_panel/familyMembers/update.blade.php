@extends('patient_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"> Update Member Details</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Member Details</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                        <form class="form-horizontal" action="{{route('membersUpdated')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <label for="memberName" class="col-md-3 form-label">Members Name</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{$member->name}}" name="memberName" id="memberName" placeholder="Name">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="email" class="col-md-3 form-label">Members E-mail</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{$member->email}}" name="email" id="email" placeholder="email@gmail.com">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>



                                <div class=" row mb-4">
                                    <label for="relation" class="col-md-3 form-label">Relation with Members</label>
                                    <div class="col-md-2">
                                        <select name="relation"  id="relation" class="form-control">
                                            <option value="">Select</option>
                                            <option value="spouse" {{($member->relation=='spouse')?'selected':''}}>Spouse/Wife</option>
                                            <option value="husband" {{($member->relation=='husband')?'selected':''}}>Husband</option>
                                            <option value="sister" {{($member->relation=='sister')?'selected':''}}>Sister</option>
                                            <option value="brother" {{($member->relation=='brother')?'selected':''}}>Brother</option>
                                            <option value="mother" {{($member->relation=='mother')?'selected':''}}>Mother</option>
                                            <option value="father" {{($member->relation=='father')?'selected':''}}>Father</option>
                                            <option value="son" {{($member->relation=='son')?'selected':''}}>Son</option>
                                            <option value="daughter" {{($member->relation=='daughter')?'selected':''}}>Daughter</option>
                                            <option value="cousin" {{($member->relation=='cousin')?'selected':''}}>Cousin</option>
                                            <option value="other" {{($member->relation=='other')?'selected':''}}>Other</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('phoneNumber'))
                                    <span class="text-danger text-left">{{ $errors->first('phoneNumber') }}</span>
                                    @endif
                                </div>
                                <input type="hidden" value="{{$member->id}}" name="id">
                                <div class="row mb-4">
                                    <div class="form-group">

                                        <label for="currentPhoneNumber">Member Phone Number :</label>
                                        <input type="text"  id="txtPhone" class="form-control" placeholder="+91 *** ******">
                                        <input type="hidden" class="form-control" id="  ">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-success">Update</button>


                                    <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>

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
