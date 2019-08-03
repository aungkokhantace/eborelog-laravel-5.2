@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($project)? "UPDATE" : "CREATE" }} PROJECT</h4>

                        <!-- start form -->
                        @if(isset($project))
                        <!-- update route -->
                        <form class="forms-sample" id="project_form" method="post" action="/projects/{{$project->id}}" enctype="multipart/form-data">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" name="id" value="{{$project->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="project_form" method="post" action="/projects" enctype="multipart/form-data">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="projects">

                                <!-- start project ID field -->
                                <div class="form-group">
                                    <label for="project_id">Project ID<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('project_id') ? 'is-invalid' :''}}" id="project_id" name="project_id" placeholder="Enter project ID" value="{{ isset($project)? $project->project_id : old('project_id') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('project_id')}}</p>
                                </div>
                                <!-- end project ID field -->

                                <!-- start project name field -->
                                <div class="form-group">
                                    <label for="name">Project Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter project name" value="{{ isset($project)? $project->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end project name field -->

                                <!-- start client name field -->
                                <div class="form-group">
                                    <label for="client_name">Client Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('client_name') ? 'is-invalid' :''}}" id="client_name" name="client_name" placeholder="Enter client name" value="{{ isset($project)? $project->client_name : old('client_name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('client_name')}}</p>
                                </div>
                                <!-- end client name field -->

                                <!-- start contract number field -->
                                <div class="form-group">
                                    <label for="contract_number">Contract Number<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('contract_number') ? 'is-invalid' :''}}" id="contract_number" name="contract_number" placeholder="Enter contract number" value="{{ isset($project)? $project->contract_number : old('contract_number') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('contract_number')}}</p>
                                </div>
                                <!-- end contract number field -->

                                <!-- start checkboxes -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class=" form-check form-check-success">
                                                <label class="form-check-label">
                                                    Is soil investigation ?
                                                    <input type="checkbox" id="is_soil_investigation" name="is_soil_investigation" class="form-check-input" @if(old("is_soil_investigation")=="on" ) checked @endif @if(isset($project) && $project->is_soil_investigation == 1) checked @endif>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" form-check form-check-success">
                                                <label class="form-check-label">
                                                    Is instrumentation ?
                                                    <input type="checkbox" id="is_instrumentation" name="is_instrumentation" class="form-check-input" @if(old("is_instrumentation")=="on" ) checked @endif @if(isset($project) && $project->is_instrumentation == 1) checked @endif>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end checkboxes -->

                                <!-- start 'project_start_date' field -->
                                <div class="form-group">
                                    <label for="project_start_date">Project Start Date<span class="required_field">*</span></label>
                                    <input class="start_date form-control" type="text" id="project_start_date" name="project_start_date" readonly placeholder="Select project start date (dd-mm-yyyy)" value="{{ isset($project)? $project->project_start_date : old('project_start_date')}}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('project_start_date')}}</p>
                                </div>
                                <!-- end 'project_start_date' field -->

                                <!-- start 'project_completion_date' field -->
                                <div class="form-group">
                                    <label for="project_completion_date">Project Completion Date</label>
                                    <input class="completion_date form-control" type="text" id="project_completion_date" name="project_completion_date" readonly placeholder="Select project completion date (dd-mm-yyyy)" value="{{ isset($project)? $project->project_completion_date : old('project_completion_date')}}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('project_completion_date')}}</p>
                                </div>
                                <!-- end 'project_completion_date' field -->

                                <!-- start note field -->
                                <div class="form-group">
                                    <label for="note">Notes</label>
                                    <textarea class="form-control {{$errors->has('note') ? 'is-invalid' :''}}" id="note" name="note" placeholder="Enter project note" rows="4">{{ isset($project)? $project->notes : old('note') }}</textarea>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('note')}}</p>
                                </div>
                                <!-- end note field -->

                                <!-- start has_wo checkbox -->
                                <div class=" form-check form-check-success">
                                    <label class="form-check-label">
                                        Has WO ?
                                        <input type="checkbox" id="has_wo" name="has_wo" class="form-check-input" @if(old("has_wo")=="on" ) checked @endif @if(isset($project) && $project->has_wo == 1) checked @endif>
                                    </label>
                                </div>
                                <!-- end has_wo checkbox -->

                                <!-- start location field -->
                                <div class="form-group has_wo_field">
                                    <label for="location">Location<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('location') ? 'is-invalid' :''}}" id="location" name="location" placeholder="Enter location" value="{{ isset($project)? $project->location : old('location') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('location')}}</p>
                                </div>
                                <!-- end location field -->

                                <!-- start location plan field -->
                                <div class="form-group has_wo_field">
                                    <label for="location_plan">Location Plan</label>
                                    <input type="file" class="form-control-file" name="location_plan" id="location_plan" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted"> Size of file should not be more than 5MB. Allowed file types: jpeg,jpg,png,JPEG,JPG,PNG,doc,docx,pdf,xls,xlsx,txt</small>
                                    @if(isset($project) && isset($project->location_plan))
                                    <a target="_blank" href="{{ $project->location_plan }}"> <strong> {{ $project->project_id }} Location Plan </strong> </a>
                                    @endif
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('location_plan')}}</p>
                                </div>
                                <!-- end location plan field -->

                                <!-- start number_of_BH field -->
                                <div class="form-group has_wo_field">
                                    <label for="number_of_bh">Number of bore holes</label>
                                    <input type="number" min="1" class="form-control {{$errors->has('number_of_bh') ? 'is-invalid' :''}}" id="number_of_bh" name="number_of_bh" placeholder="Enter number of bore holes" value="{{ isset($project)? $project->number_of_bh : old('number_of_bh') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('number_of_bh')}}</p>
                                </div>
                                <!-- end number_of_BH field -->

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
                                            <input type="checkbox" id="user_{{$user->id}}" name="user_{{$user->id}}" class="form-check-input" @if(old($old_user_checkbox_value_string)=="on" ) checked @endif @if((isset($project)) && (in_array($user->id,$project_user_IDs))) checked @endif>
                                        </label>
                                    </div>
                                    @endforeach
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('users')}}</p>
                                </div>
                                <!-- end assign_to_users field -->

                                <!-- buttons -->
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button id="cancel_button" class="btn btn-light">Cancel</button>
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
            //check on page load, if has_wo is checked, hide corresponding fields
            if ($('#has_wo').is(":checked")) {
                $(".has_wo_field").hide();
            }

            //Start Validation for Entry and Edit Form
            $('#project_forms').validate({
                rules: {
                    project_id: 'required',
                    name: 'required',
                    client_name: 'required',
                    contract_number: 'required',
                    project_start_date: 'required',
                    location: 'required',
                },
                messages: {
                    project_id: 'Project ID is required',
                    name: 'Project name is required',
                    client_name: 'Client name is required',
                    contract_number: 'Contract number is required',
                    project_start_date: 'Project start date is required',
                    location: 'Location is required',
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

        $('#has_wo').change(function() {
            if ($('#has_wo').is(":checked")) {
                $(".has_wo_field").hide();
            } else {
                $(".has_wo_field").show();
            }
        });
    </script>
    @endsection
