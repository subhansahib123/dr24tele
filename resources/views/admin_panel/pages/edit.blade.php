@extends('admin_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Edit Page</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Page</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header row">
                                <h3 class="card-title col-md-12">Edit Page:</h3>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                    @endforeach
                                </div>
                                @endif

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Name :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$page->name}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Slug :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slug" value="{{$page->slug}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Status :</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" value="{{$page->status}}">
                                            <option value="1" {{ ($page->status == "1") ? "selected" : '' }}>Active</option>
                                            <option value="0" {{ ($page->status == "0") ? "selected" : '' }}>In Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Feature :</label>
                                    <div class="col-md-9">
                                        <img src="{{asset('assets/images/media/files/'.$page->feature)}}" width="100px">
                                        <input type="file" class="form-control" name="feature" value="{{$page->feature}}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Description :</label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="description" rows="7" id="editor">{{$page->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button href="submit" class="btn btn-primary">Edit Page</button>
                                        <a href="{{route('pages.index')}}" class="btn btn-default float-end">Discard</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ROW END -->

        </div>
        <!-- CONTAINER END -->
    </div>
</div>

@endsection
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>