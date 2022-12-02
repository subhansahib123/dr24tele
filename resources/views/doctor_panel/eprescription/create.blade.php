@extends('doctor_panel.layout.master');

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                @include('doctor_panel.frontend.includes.messages')

                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create E-Prescription</li>
                                    </ol>
                                </div>
                                <div class="col-3">
                                    <span class="card-title"><strong>E-Prescription</strong></span>
                                </div>

                                <div class="col-4 text-end">

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('doctor.eprescription.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="organization_id" value="1">
                                    <input type="hidden" name="doctor_id" value="1">
                                    <input type="hidden" name="patient_id" value="1">
                                    <input type="hidden" name="appointment_id" value="1">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                    @endif
                                    <div class="container">
                                        <table class="table table-bordered" id="dynamicTable">
                                            <tr>
                                                <th>Medicine</th>
                                                <th>Comment</th>
                                                <th colspan="3" class="text-center">Doze Timing</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="eprescription[0][medicine]"
                                                           placeholder="Enter Medicine Name"
                                                           class="form-control"/>
                                                </td>
                                                <td><input type="text" name="eprescription[0][comment]"
                                                           placeholder="Enter Description"
                                                           class="form-control"/>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input name="eprescription[0][morning]" class="form-check-input"
                                                               type="checkbox">
                                                        <label class="form-check-label"
                                                               for="flexCheckChecked">Morning</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input name="eprescription[0][after_noon]" id="afternoon"
                                                               class="form-check-input" type="checkbox">
                                                        <label class="form-check-label" for="afternoon">After
                                                            Noon</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input name="eprescription[0][evening]" id="evening"
                                                               class="form-check-input" type="checkbox">
                                                        <label class="form-check-label" for="evening">Evening</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" name="add" id="add"
                                                        class="btn btn-success col-6 offset-3">Add More
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 offset-11">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot_script')
    <tr>
        <td><input type="text" name="eprescription[0][medicine]" placeholder="Enter Medicine Name" class="form-control"/></td>
        <td><input type="text" name="eprescription[0][comment]" placeholder="Enter Description" class="form-control"/></td>
        <td>
            <div class="form-check"><input name="eprescription[0][morning]" class="form-check-input" type="checkbox"
                                           value="0"><label class="form-check-label"
                                                            for="flexCheckChecked">Morning</label></div>
        </td>
        <td>
            <div class="form-check"><input name="eprescription[0][after_noon]" id="afternoon" class="form-check-input"
                                           type="checkbox" value="0"><label class="form-check-label" for="afternoon">After
                    Noon</label></div>
        </td>
        <td>
            <div class="form-check"><input name="eprescription[0][evening]" id="evening" class="form-check-input"
                                           type="checkbox" value="0"><label class="form-check-label" for="evening">Evening</label>
            </div>
        </td>
    </tr>
    <script type="text/javascript">
        var i = 0;
        $("#add").click(function () {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="eprescription[' + i + '][medicine]" placeholder="Enter Medicine Name" class="form-control"/></td><td><input type="text" name="eprescription[' + i + '][comment]" placeholder="Enter Description" class="form-control"/></td><td><div class="form-check"><input  name="eprescription[' + i + '][morning]" class="form-check-input" type="checkbox"><label class="form-check-label" for="flexCheckChecked">Morning</label></div></td><td><div  class="form-check"><input  name="eprescription[' + i + '][after_noon]" id="afternoon" class="form-check-input" type="checkbox"><label class="form-check-label" for="afternoon">After Noon</label></div></td><td><div  class="form-check"><input  name="eprescription[' + i + '][evening]" id="evening" class="form-check-input" type="checkbox"><label class="form-check-label" for="evening">Evening</label></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });
    </script>

@endsection
