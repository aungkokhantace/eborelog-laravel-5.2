@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">WO DETAIL</h4>

                        <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                        <input type="hidden" id="module" name="module" value="wo">

                        <input type="hidden" id="project_id" name="project_id" value="{{$project_id}}">

                        <!-- start project ID field -->
                        <div class="form-group">
                            <label for="project_id_name">Project ID<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="project_id_name" name="project_id_name" placeholder="Enter project id" value="{{ isset($project_id_name)? $project_id_name : old('project_id_name') }}">
                        </div>
                        <!-- end project ID field -->

                        <!-- start WO number field -->
                        <div class="form-group">
                            <label for="wo_number">WO Number<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control" id="wo_number" name="wo_number" placeholder="Enter wo number" value="{{ isset($wo)? $wo->wo_number : old('wo_number') }}">
                        </div>
                        <!-- end WO number field -->

                        <!-- start number_of_BH field -->
                        <div class="form-group has_wo_field">
                            <label for="number_of_bh">Number of bore holes</label>
                            <input type="text" readonly class="form-control {{$errors->has('number_of_bh') ? 'is-invalid' :''}}" id="number_of_bh" name="number_of_bh" placeholder="Enter number of bore holes" value="{{ isset($wo)? $wo->number_of_bh : old('number_of_bh') }}">
                        </div>
                        <!-- end number_of_BH field -->

                        <!-- start location field -->
                        <div class="form-group has_wo_field">
                            <label for="location">Location<span class="required_field">*</span></label>
                            <input type="text" readonly class="form-control {{$errors->has('location') ? 'is-invalid' :''}}" id="location" name="location" placeholder="Enter location" value="{{ isset($wo)? $wo->location : old('location') }}">
                        </div>
                        <!-- end location field -->

                        <!-- start location plan field -->
                        <div class="form-group has_wo_field">
                            <label for="location_plan">Location Plan: </label>
                            @if(isset($wo) && isset($wo->location_plan))
                            <a target="_blank" href="{{ $wo->location_plan }}"> <strong> {{ $wo->wo_number }} Location Plan </strong> </a>
                            @endif
                        </div>
                        <!-- end location plan field -->

                        <!-- start 'wo_start_date' field -->
                        <div class="form-group">
                            <label for="wo_start_date">WO Start Date<span class="required_field">*</span></label>
                            <input class="start_date form-control" type="text" readonly id="wo_start_date" name="wo_start_date" readonly placeholder="Select wo start date (dd-mm-yyyy)" value="{{ isset($wo)? $wo->wo_start_date : old('wo_start_date')}}">
                        </div>
                        <!-- end 'wo_start_date' field -->

                        <!-- start 'wo_completion_date' field -->
                        <div class="form-group">
                            <label for="project_completion_date">WO Completion Date</label>
                            <input class="completion_date form-control" type="text" readonly id="wo_completion_date" name="wo_completion_date" readonly placeholder="Select wo completion date (dd-mm-yyyy)" value="{{ isset($wo)? $wo->wo_completion_date : old('wo_completion_date')}}">
                        </div>
                        <!-- end 'wo_completion_date' field -->

                        <!-- start assign_to_users field -->
                        <div class="form-group has_wo_field">
                            <label for="users">Assign to users</label>
                            <ul>
                                @foreach($wo_users as $user)
                                <li>
                                    {{$user->name}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- end assign_to_users field -->

                        <!-- start go back button -->
                        <a href="/wo/{{$project_id}}">
                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Go back to WO list">
                                <i class="mdi mdi-arrow-left-bold"></i> WO List
                            </button>
                        </a>
                        <!-- end go back button -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection

    @section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {});
    </script>
    @endsection
