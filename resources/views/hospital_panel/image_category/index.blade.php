@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Categories</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Categories List</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-6">
                                <div class="card">
                                    {{-- <div class="card-header"> --}}
                                        <div class="row">
                                            <div class="col-md-3 p-3 px-3 text-center"><span class="card-title">Categories List</span></div>
                                            <div class="col-md-7 algn-self-center"></div>
                                            <div class="col-md-2 p-3 px-3 text-center"><span class=""><a class="btn btn-primary" href="{{route('image_categories.create')}}"><i
                                                class="angle fe fe-plus"></i> </a></span></div>

                                        </div>


                                    {{-- </div> --}}
                                    <div class="card-body">

                                        @include('admin_panel.frontend.includes.messages')
                                        {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                        <div class="table-responsive">
                                            <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Parent Category</th>

                                                        <th>Title</th>
                                                        <th>Slug</th>
                                                        <th>Dsscription</th>
                                                        <th>Image</th>


                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($categories as $category )
                                                    <tr>
                                                        <td>{{ $loop->index +1}}</td>
                                                        <td>
                                                            @if($category->parentCategory)
                                                            {{$category->parentCategory->title}}
                                                            @else
                                                            <h4>It Self Parent</h4>
                                                            @endif


                                                        </td>

                                                        <td>{{$category->title}}</td>
                                                        <td>{{$category->slug}}</td>
                                                        <td>{{$category->des}}</td>
                                                        <td><img src='{{asset($category->image)}}' width="100px" height="100px"/></td>

                                                        <td>

                                                        <a href="{{route('image_categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['image_categories.destroy', $category->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                        {!! Form::close() !!}
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
                    </div>
                    <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection
