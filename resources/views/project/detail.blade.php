@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PROJECT DETAIL</h4>

                        <!-- start project ID field -->
                        <div class="form-group">
                            <label for="project_id">Project ID<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="project_id" name="project_id" placeholder="Enter project ID" value="{{ isset($project)? $project->project_id : old('project_id') }}">
                        </div>
                        <!-- end project ID field -->

                        <!-- start project name field -->
                        <div class="form-group">
                            <label for="name">Project Name<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="name" name="name" placeholder="Enter project name" value="{{ isset($project)? $project->name : old('name') }}">
                        </div>
                        <!-- end project name field -->

                        <!-- start client name field -->
                        <div class="form-group">
                            <label for="client_name">Client Name<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="client_name" name="client_name" placeholder="Enter client name" value="{{ isset($project)? $project->client_name : old('client_name') }}">
                        </div>
                        <!-- end client name field -->

                        <!-- start contract number field -->
                        <div class="form-group">
                            <label for="contract_number">Contract Number<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="contract_number" name="contract_number" placeholder="Enter contract number" value="{{ isset($project)? $project->contract_number : old('contract_number') }}">
                        </div>
                        <!-- end contract number field -->

                        <!-- start checkboxes -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class=" form-check form-check-success">
                                        <label>
                                            Is soil investigation ? : <strong>{{((isset($project)) && ($project->is_soil_investigation == 1)) ? "Yes" : "No" }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class=" form-check form-check-success">
                                        <label>
                                            Is instrumentation ? : <strong>{{((isset($project)) && ($project->is_instrumentation == 1)) ? "Yes" : "No" }}</strong>
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
                        </div>
                        <!-- end 'project_start_date' field -->

                        <!-- start 'project_completion_date' field -->
                        <div class="form-group">
                            <label for="project_completion_date">Project Completion Date</label>
                            <input class="completion_date form-control" type="text" id="project_completion_date" name="project_completion_date" readonly placeholder="Project completion date (dd-mm-yyyy)" value="{{ isset($project)? $project->project_completion_date : old('project_completion_date')}}">
                        </div>
                        <!-- end 'project_completion_date' field -->

                        <!-- start note field -->
                        <div class="form-group">
                            <label for="note">Notes</label>
                            <textarea readonly class="form-control" id="note" name="note" placeholder="Enter project note" rows="4">{{ isset($project)? $project->notes : old('note') }}</textarea>
                        </div>
                        <!-- end note field -->

                        <!-- start has_wo checkbox -->
                        <div class=" form-check form-check-success">
                            <label>
                                Has WO ? : <strong>{{((isset($project)) && ($project->has_wo == 1)) ? "Yes" : "No" }}</strong>
                            </label>
                        </div>
                        <!-- end has_wo checkbox -->

                        <!-- start location field -->
                        <div class="form-group has_wo_field">
                            <label for="location">Location<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="location" name="location" placeholder="Enter location" value="{{ isset($project)? $project->location : old('location') }}">
                        </div>
                        <!-- end location field -->

                        <!-- start location plan field -->
                        <div class="form-group has_wo_field">
                            <label for="location_plan">Location Plan : </label>
                            @if(isset($project) && isset($project->location_plan))
                            <a target="_blank" href="{{ $project->location_plan }}"> <strong> {{ $project->project_id }} Location Plan </strong> </a>
                            @endif
                        </div>
                        <!-- end location plan field -->

                        <!-- start number_of_BH field -->
                        <div class="form-group has_wo_field">
                            <label for="number_of_bh">Number of bore holes</label>
                            <input type="number" readonly min="1" class="form-control" id="number_of_bh" name="number_of_bh" placeholder="Enter number of bore holes" value="{{ isset($project)? $project->number_of_bh : old('number_of_bh') }}">
                        </div>
                        <!-- end number_of_BH field -->

                        <!-- start assign_to_users field -->
                        <div class="form-group has_wo_field">
                            <label for="users">Assign to users</label>
                            <ul>
                                @foreach($project_users as $user)
                                <li>
                                    {{$user->name}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- end assign_to_users field -->

                        <!-- go back button -->
                        <a href="/projects"><button type="button" class="btn btn-primary"> Back to project list </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- content-wrapper ends -->
    @endsection

    @section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
                    //check on page load, if has_wo is checked, hide corresponding fields
                    if ($('#has_wo').is(":checked")) {
                        $(".has_wo_field").hide();
                    }
    </script>
    @endsection
