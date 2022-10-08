@extends('admin_panel.layout.master');

@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Testimonials</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="row">
                                            <div class="col-md-3 p-3 px-3 text-center"><span class="card-title">Testimonials</span></div>
                                            <div class="col-md-7 algn-self-center"></div>
                                            <div class="col-md-2 p-3 px-3 text-center"><span class=""><a class="btn btn-primary" href="{{route('testimonials.create')}}"><i
                                                class="angle fe fe-plus"></i> </a></span></div>

                                        </div>
                        </div>
                        <div class="card-body">
                            
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <span>{{ $message }}</span>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="data-table table border dataTable no-footer text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Rating</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Designation</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $detail)
                                            <tr>
                                                <td>{{$detail->id}}</td>
                                                <td>{{$detail->title}}</td>
                                                <td><img src="{{asset('assets/images/users/'.$detail->image)}}" width="50px"></td>
                                                <td>{{$detail->rating}}</td>
                                                <td>{{$detail->email}}</td>
                                                <td>{{$detail->subject}}</td>
                                                <td>{{$detail->designation}}</td>
                                                <td>{{$detail->description}}</td>
                                                <td>{{ ($detail->status == "1") ? "Active" : "In Active"}}</td>
                                                <td>{{$detail->created_at}}</td>
                                                <td class="text-center align-middle">
                                                    <form action="{{ route('testimonials.destroy', $detail->id) }}" method="POST">
                                                        <div class="btn-group align-top btn-list">
                                                            <a class="btn btn-sm btn-primary badge" href="{{ route('testimonials.edit', $detail->id) }}"><i class="fa fa-edit"></i></a>

                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-sm btn-danger badge" type="submit" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW END -->

        </div>
        <!-- CONTAINER END -->
    </div>
</div>

@endsection