@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Blog Edit</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog Edit</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Blog Edit




                                        </h4>
                                    </div>
                                    @include('admin_panel.frontend.includes.messages')

                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('patch')
                                            @csrf

                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Title</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{ $blog->title }}" name="title" id="inputName" placeholder="Title" autocomplete="tilte">
                                                </div>
                                                @if ($errors->has('title'))
                                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Slug</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{ $blog->slug }}" name="slug" id="slug" placeholder="Slug" autocomplete="userslugname">
                                                </div>
                                                @if ($errors->has('slug'))
                                                    <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Categories</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" value="" name="category_id" >
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category )
                                                            <option value="{{$category->id}}" {{$category->id==$blog->category->id?'selected':''}}>{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('category_id'))
                                                    <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Description</label>
                                                <div class="col-md-9">
                                                    <textarea  class="form-control ck" value="" name="des"  placeholder="Description" autocomplete="userslugname">{{ $blog->slug }}</textarea>
                                                </div>
                                                @if ($errors->has('des'))
                                                    <span class="text-danger text-left">{{ $errors->first('des') }}</span>
                                                @endif
                                            </div>
                                            <div class=" row mb-4">
                                                <label for="inputName" class="col-md-3 form-label"> Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" value="" name="image" >
                                                </div>
                                                <img src="{{asset($blog->image)}}" width="100px"  height="60px"/>
                                                 @if ($errors->has('image'))
                                                    <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>


                                            <div class="mb-0 row justify-content-end">
                                                <div class="col-md-9">
                                                    <label class="custom-control custom-checkbox">
                                                            <input type="checkbox"

                                                            {{$blog->status==1 ? 'checked':''}}
                                                            class="custom-control-input" name="status" >
                                                            <span class="custom-control-label">Status</span>
                                                        </label>
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
