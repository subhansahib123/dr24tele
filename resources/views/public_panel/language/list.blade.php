@extends('admin_panel.layout.master');

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Languages</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Languages List</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="alert alert-success" id="success_message" style="display: none">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24"><path fill="#13bfa6" d="M10.3125,16.09375a.99676.99676,0,0,1-.707-.293L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328l-6.1875,6.1875A.99676.99676,0,0,1,10.3125,16.09375Z" opacity=".99"></path><path fill="#71d8c9" d="M12,2A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm5.207,7.61328-6.1875,6.1875a.99963.99963,0,0,1-1.41406,0L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328Z"></path></svg></span>
                    <strong>Success Message</strong>
                    <hr class="message-inner-separator">
                    <p> </p>
                </div>
                <div class="alert alert-danger" id="error_message" style="display: none">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"></path><circle cx="12" cy="17" r="1" fill="#e62a45"></circle><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"></path></svg></span>
                    <strong>Danger Message</strong>
                    <hr class="message-inner-separator">

                    <p></p>

                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">Languages List</span>

                                {{-- <span class="card-title "><a href="{{route('Users.create')}}"> Add New Tool</a></span> --}}
                            </div>
                            <div class="card-body">

                                @include('admin_panel.frontend.includes.messages')
                                {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                <div class="table-responsive">
                                    <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Code</th>
                                                <th>Title</th>
                                                <th>Status</th>




                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($languages as $language)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $language->id }}</td>
                                                    <td>{{ $language->value }}</td>
                                                    <td>


                                                        <div class="col-xl-2 px-3 px-xl-1">
                                                            <div class="form-group">
                                                                <label class="custom-switch form-switch mb-0">
                                                                    <input type="checkbox"

                                                                        name="custom-switch-radio"
                                                                        language_id={{$language->id}}
                                                                        {{$language->status==1?'checked':''}}
                                                                        class="custom-switch-input">
                                                                    <span
                                                                        class="custom-switch-indicator custom-switch-indicator-lg"></span>

                                                                </label>
                                                            </div>
                                                        </div>



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
@section('foot_script')
    <script>

        $('input[name="custom-switch-radio"]').change(function(){
            var status=0;
          if($(this).is(':checked'))
             status=1;
            $.ajax({
                url: '{{ route('language.changeStatus') }}',
                type: 'POST',
                data: {
                    language_id: $(this).attr('language_id'),
                    status: status


                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response);
                    // if(response.success)
                    // {
                    //     $('#success_message').show();
                    //     $('#success_message p').html(response.msg)

                    // }else {
                    //     $('#error_message').show();
                    //     $('#error_message p').html(response.msg)
                    // }
                },
                error: function(error) {
                    // console.log(error);
                    // $('#error_message').show();
                    // $('#error_message p').html(error)
                },
            });
        });
        
    </script>
@endsection
