@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($wo)? "UPDATE" : "CREATE" }} WO</h4>

                        <!-- start form -->
                        @if(isset($wo))
                        <!-- update route -->
                        <form class="forms-sample" id="wo_form" method="post" action="/wo/{{$project_id}}/{{$wo->id}}/update" enctype="multipart/form-data">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}
                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="wo_form" method="post" action="/wo/{{$project_id}}/store" enctype="multipart/form-data">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="wo">

                                <input type="hidden" id="project_id" name="project_id" value="{{$project_id}}">

                                <!-- start project ID field -->
                                <div class="form-group">
                                    <label for="project_id_name">Project ID<span class="required_field">*</span></label>
                                    <input type="text" readonly class="form-control" id="project_id_name" name="project_id_name" placeholder="Enter project id" value="{{ isset($project_id_name)? $project_id_name : old('project_id_name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('project_id_name')}}</p>
                                </div>
                                <!-- end project ID field -->

                                <!-- start WO number field -->
                                <div class="form-group">
                                    <label for="wo_number">WO Number<span class="required_field">*</span></label>
                                    <input type="text" class="form-control" id="wo_number" name="wo_number" placeholder="Enter wo number" value="{{ isset($wo)? $wo->wo_number : old('wo_number') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('wo_number')}}</p>
                                </div>
                                <!-- end WO number field -->

                                <!-- start number_of_BH field -->
                                <div class="form-group has_wo_field">
                                    <label for="number_of_bh">Number of bore holes</label>
                                    <input type="number" min="1" class="form-control {{$errors->has('number_of_bh') ? 'is-invalid' :''}}" id="number_of_bh" name="number_of_bh" placeholder="Enter number of bore holes" value="{{ isset($wo)? $wo->number_of_bh : old('number_of_bh') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('number_of_bh')}}</p>
                                </div>
                                <!-- end number_of_BH field -->

                                <!-- start location field -->
                                <div class="form-group has_wo_field">
                                    <label for="location">Location<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('location') ? 'is-invalid' :''}}" id="location" name="location" placeholder="Enter location" value="{{ isset($wo)? $wo->location : old('location') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('location')}}</p>
                                </div>
                                <!-- end location field -->

                                <!-- start location plan field -->
                                <div class="form-group has_wo_field">
                                    <label for="location_plan">Location Plan</label>
                                    <input type="file" class="form-control-file" name="location_plan" id="location_plan" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted"> Size of file should not be more than 5MB. Allowed file types: jpeg,jpg,png,JPEG,JPG,PNG,doc,docx,pdf,xls,xlsx,txt</small>
                                    @if(isset($wo) && isset($wo->location_plan))
                                    <a target="_blank" href="{{ $wo->location_plan }}"> <strong> {{ $wo->wo_number }} Location Plan </strong> </a>
                                    @endif
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('location_plan')}}</p>
                                </div>
                                <!-- end location plan field -->

                                <!-- start 'wo_start_date' field -->
                                <div class="form-group">
                                    <label for="wo_start_date">WO Start Date<span class="required_field">*</span></label>
                                    <input class="start_date form-control" type="text" id="wo_start_date" name="wo_start_date" readonly placeholder="Select wo start date (dd-mm-yyyy)" value="{{ isset($wo)? $wo->wo_start_date : old('wo_start_date')}}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('wo_start_date')}}</p>
                                </div>
                                <!-- end 'wo_start_date' field -->

                                <!-- start 'wo_completion_date' field -->
                                <div class="form-group">
                                    <label for="project_completion_date">WO Completion Date</label>
                                    <input class="completion_date form-control" type="text" id="wo_completion_date" name="wo_completion_date" readonly placeholder="Select wo completion date (dd-mm-yyyy)" value="{{ isset($wo)? $wo->wo_completion_date : old('wo_completion_date')}}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('wo_completion_date')}}</p>
                                </div>
                                <!-- end 'wo_completion_date' field -->

                                <!-- start assign_to_users field -->
                                <div class="form-group has_wo_field">
                                    <label for="users">Assign to users</label>
                                    @foreach($users as $user)
                                    <div class=" form-check form-check-success">
                                        <label class="form-check-label">
                                            {{$user->name}}

                                            <!-- combine the string to use in old() after validation error -->
                                            <?php $old_user_checkbox_value_string = "user_" . $user->id; ?>

                                            <input type="hidden" name="user_{{$user->id}}" value="">
                                            <input type="checkbox" id="user_{{$user->id}}" name="user_{{$user->id}}" class="form-check-input" @if(old($old_user_checkbox_value_string)=="on" ) checked @endif @if((isset($wo)) && (in_array($user->id,$wo_user_IDs))) checked @endif>
                                        </label>
                                    </div>
                                    @endforeach
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('users')}}</p>
                                </div>
                                <!-- end assign_to_users field -->

                                <!-- buttons -->
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button id="cancel_button_with_project_id" class="btn btn-light">Cancel</button>
                                <!-- buttons -->
                            </form>
                            <!-- end form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection

    @section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Entry and Edit Form
            $('#wo_form').validate({
                rules: {
                    wo_number: 'required',
                    number_of_bh: 'required',
                    location: 'required',
                    location_plan: 'required',
                    wo_start_date: 'required',
                },
                messages: {
                    wo_number: 'WO number is required',
                    number_of_bh: 'Number of bore holes is required',
                    location: 'Location is required',
                    location_plan: 'Location plan is required',
                    wo_start_date: 'WO start date is required',
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });

        $('.start_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            todayBtn: 'linked',
            todayHighlight: true,
            toggleActive: true,
        });

        $('.completion_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            todayBtn: 'linked',
            todayHighlight: true,
            toggleActive: true,
        });
    </script>
    @endsection
