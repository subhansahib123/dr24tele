@extends('admin_panel.layout.master');

@section('content')
<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Page</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Page</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header">
                                <div class="card-title">Add New Page</div>
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
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Slug :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slug">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Status :</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Feature :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="feature">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Description :</label>
                                    <div class="col-md-9">

                                        <textarea class="ckeditor form-control" name="description" rows="7" id="editor"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Add New Page</button>
                                        <a href="{{route('pages.index')}}" class="btn btn-default float-end">Discard</a>
                                    </div>
                                </div>
                                <!--End Row-->
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
<!--app-content close-->
@endsection

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>