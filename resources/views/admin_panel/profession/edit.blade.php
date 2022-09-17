@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Role Edit</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Role Edit</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Role Edit





                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{ route('roles.update', $role->id) }}" method="POST">
                                            @method('patch')
                                            @csrf
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" value="{{ $role->name }}"  class="form-control" name="name" id="inputName" placeholder="Name" autocomplete="username">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="row md-4">
                                                <label for="permissions" class="form-label">Assign Permissions</label>
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                                                            <th scope="col" width="20%">Name</th>
                                                            <th scope="col" width="1%">Guard</th>
                                                        </thead>

                                                        @foreach($permissions as $permission)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox"
                                                                    name="permission[{{ $permission->name }}]"
                                                                    value="{{ $permission->name }}"
                                                                    class='permission'
                                                                    {{ in_array($permission->name, $rolePermissions)
                                                                        ? 'checked'
                                                                        : '' }}>
                                                                </td>
                                                                <td>{{ $permission->name }}</td>
                                                                <td>{{ $permission->guard_name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary">Cancel</button>
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
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked',true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked',false);
                });
            }

        });
    });
</script>
@endsection
