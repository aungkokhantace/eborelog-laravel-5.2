@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($bore_hole)? "UPDATE" : "CREATE" }} BORE HOLE</h4>

                        <!-- start form -->
                        @if(isset($bore_hole))
                        <!-- update route -->
                        <form class="forms-sample" id="bore_hole_form" method="post" action="/bore_holes/{{$bore_hole->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" id="id" name="id" value="{{$bore_hole->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="bore_hole_form" method="post" action="/bore_holes">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="bore_holes">

                                <!-- start hole_id field -->
                                <div class="form-group">
                                    <label for="name">Hole ID<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('hole_id') ? 'is-invalid' :''}}" id="hole_id" name="hole_id" placeholder="Enter bore hole ID" value="{{ isset($bore_hole)? $bore_hole->hole_id : old('hole_id') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('hole_id')}}</p>
                                </div>
                                <!-- end hole_id field -->

                                <!-- start driller field -->
                                <div class="form-group">
                                    <label for="driller_id">Driller<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="driller_id" name="driller_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($drillers as $driller)
                                        <option value="{{$driller->id}}" @if($driller->id == $bore_hole->driller_id) selected @endif>{{$driller->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Driller </option>
                                        @foreach($drillers as $driller)
                                        <option value="{{$driller->id}}" @if(old('driller_id')==$driller->id) selected @endif>{{$driller->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('driller_id')}}</p>
                                </div>
                                <!-- end driller field -->

                                <!-- start supervisor/geologist field -->
                                <div class="form-group">
                                    <label for="supervisor_id">Supervisor/Geologist<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="supervisor_id" name="supervisor_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($supervisors as $supervisor)
                                        <option value="{{$supervisor->id}}" @if($supervisor->id == $bore_hole->supervisor_id) selected @endif>{{$supervisor->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Supervisor/Geologist </option>
                                        @foreach($supervisors as $supervisor)
                                        <option value="{{$supervisor->id}}" @if(old('supervisor_id')==$supervisor->id) selected @endif>{{$supervisor->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('supervisor_id')}}</p>
                                </div>
                                <!-- end supervisor/geologist field -->

                                <!-- start casing field -->
                                <div class="form-group">
                                    <label for="casing_id">Casing<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="casing_id" name="casing_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($casings as $casing)
                                        <option value="{{$casing->id}}" @if($casing->id == $bore_hole->casing_id) selected @endif>{{$casing->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Casing </option>
                                        @foreach($casings as $casing)
                                        <option value="{{$casing->id}}" @if(old('casing_id')==$casing->id) selected @endif>{{$casing->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('casing_id')}}</p>
                                </div>
                                <!-- end casing field -->

                                <!-- start diameter field -->
                                <div class="form-group">
                                    <label for="diameter">Diameter<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('diameter') ? 'is-invalid' :''}}" id="diameter" name="diameter" placeholder="Enter diameter" value="{{ isset($bore_hole)? $bore_hole->diameter : old('diameter') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('diameter')}}</p>
                                </div>
                                <!-- end diameter field -->

                                <!-- start orientation field -->
                                <div class="form-group">
                                    <label for="orientation">Orientation<span class="required_field">*</span></label>
                                    @if(isset($bore_hole))
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="orientation" id="radio_vertical" value="Vertical" @if($bore_hole->orientation == "Vertical") checked @endif>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="orientation" id="radio_inclined" value="Inclined" @if($bore_hole->orientation == "Inclined") checked @endif>
                                            No
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="orientation" id="radio_vertical" value="Vertical" checked>
                                            Vertical
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="orientation" id="radio_inclined" value="Inclined">
                                            Inclined
                                        </label>
                                    </div>
                                    @endif
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('orientation')}}</p>
                                </div>
                                <!-- end orientation field -->

                                <!-- start date/time field -->
                                <div class="form-group">
                                    <label for="project_start_date">Start Date/Time<span class="required_field">*</span></label>
                                    <div class="row">
                                        <!-- start datepicker -->
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 div-with-margin">
                                            <input class="start_date form-control" type="text" id="project_start_date" name="project_start_date" readonly placeholder="Select start date (dd-mm-yyyy)" value="{{ isset($project)? $project->project_start_date : old('project_start_date')}}">
                                        </div>
                                        <!-- end datepicker -->

                                        <!-- start timepicker -->
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 div-with-margin">
                                            <div class="form-group">
                                                <input id="timepicki" type="text" name="timepicker" class="form-control" readonly />
                                            </div>
                                        </div>


                                        <!-- end timepicker -->
                                        <!-- validation error message -->
                                        <p class="text-danger">{{$errors->first('project_start_date')}}</p>
                                    </div>
                                </div>
                                <!-- end date/time field -->

                                <!-- start general remark field -->
                                <div class="form-group">
                                    <label for="general_remark">General Remark<span class="required_field">*</span></label>
                                    <textarea class="form-control" id="general_remark" name="general_remark" placeholder="Enter general remark" rows="4">{{isset($bore_hole)?$bore_hole->general_remark:old('general_remark')}}</textarea>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('general_remark')}}</p>
                                </div>
                                <!-- end general remark field -->

                                <!-- start location_description field -->
                                <div class="form-group">
                                    <label for="location_description">Location Description<span class="required_field">*</span></label>
                                    <textarea class="form-control" id="location_description" name="location_description" placeholder="Enter location description" rows="4">{{isset($bore_hole)?$bore_hole->location_description:old('location_description')}}</textarea>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('location_description')}}</p>
                                </div>
                                <!-- end location_description field -->

                                <!-- start north field -->
                                <div class="form-group">
                                    <label for="north">North<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('north') ? 'is-invalid' :''}}" id="north" name="north" placeholder="Enter north" value="{{ isset($bore_hole)? $bore_hole->north : old('north') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('north')}}</p>
                                </div>
                                <!-- end north field -->

                                <!-- start east field -->
                                <div class="form-group">
                                    <label for="east">East<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('east') ? 'is-invalid' :''}}" id="east" name="east" placeholder="Enter east" value="{{ isset($bore_hole)? $bore_hole->east : old('east') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('east')}}</p>
                                </div>
                                <!-- end east field -->

                                <!-- start elevation field -->
                                <div class="form-group">
                                    <label for="elevation">Elevation<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('elevation') ? 'is-invalid' :''}}" id="elevation" name="elevation" placeholder="Enter elevation" value="{{ isset($bore_hole)? $bore_hole->elevation : old('elevation') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('elevation')}}</p>
                                </div>
                                <!-- end elevation field -->

                                <!-- start offset field -->
                                <div class="form-group">
                                    <label for="offset">Offset<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('offset') ? 'is-invalid' :''}}" id="offset" name="offset" placeholder="Enter offset" value="{{ isset($bore_hole)? $bore_hole->offset : old('offset') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('offset')}}</p>
                                </div>
                                <!-- end offset field -->

                                <!-- start drilling_company field -->
                                <div class="form-group">
                                    <label for="drilling_company_id">Drilling Company<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="drilling_company_id" name="drilling_company_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($drilling_companies as $drilling_company)
                                        <option value="{{$drilling_company->id}}" @if($drilling_company->id == $bore_hole->drilling_company_id) selected @endif>{{$drilling_company->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Drilling Company </option>
                                        @foreach($drilling_companies as $drilling_company)
                                        <option value="{{$drilling_company->id}}" @if(old('drilling_company_id')==$drilling_company->id) selected @endif>{{$drilling_company->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('drilling_company_id')}}</p>
                                </div>
                                <!-- end drilling_company field -->

                                <!-- start drilling_rig field -->
                                <div class="form-group">
                                    <label for="drilling_rig_id">Drilling Rig<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="drilling_rig_id" name="drilling_rig_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($drilling_rigs as $drilling_rig)
                                        <option value="{{$drilling_rig->id}}" @if($drilling_rig->id == $bore_hole->drilling_rig_id) selected @endif>{{$drilling_rig->rig_no}}({{$drilling_rig->model}})</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Drilling Rig </option>
                                        @foreach($drilling_rigs as $drilling_rig)
                                        <option value="{{$drilling_rig->id}}" @if(old('drilling_rig_id')==$drilling_rig->id) selected @endif>{{$drilling_rig->rig_no}}({{$drilling_rig->model}})</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('drilling_rig_id')}}</p>
                                </div>
                                <!-- end drilling_rig field -->

                                <!-- start drilling_method field -->
                                <div class="form-group">
                                    <label for="drilling_method_id">Drilling Method<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="drilling_method_id" name="drilling_method_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($drilling_methods as $drilling_method)
                                        <option value="{{$drilling_method->id}}" @if($drilling_method->id == $bore_hole->drilling_method_id) selected @endif>{{$drilling_method->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Drilling Method </option>
                                        @foreach($drilling_methods as $drilling_method)
                                        <option value="{{$drilling_method->id}}" @if(old('drilling_method_id')==$drilling_method->id) selected @endif>{{$drilling_method->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('drilling_method_id')}}</p>
                                </div>
                                <!-- end drilling_method field -->

                                <!-- start spt_method field -->
                                <div class="form-group">
                                    <label for="spt_method_id">SPT Method<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="spt_method_id" name="spt_method_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($spt_methods as $spt_method)
                                        <option value="{{$spt_method->id}}" @if($spt_method->id == $bore_hole->spt_method_id) selected @endif>{{$spt_method->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select SPT Method </option>
                                        @foreach($spt_methods as $spt_method)
                                        <option value="{{$spt_method->id}}" @if(old('spt_method_id')==$spt_method->id) selected @endif>{{$spt_method->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('spt_method_id')}}</p>
                                </div>
                                <!-- end spt_method field -->

                                <!-- start spt_hammer_number field -->
                                <div class="form-group">
                                    <label for="spt_hammer_number">SPT Hammer Number<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('spt_hammer_number') ? 'is-invalid' :''}}" id="spt_hammer_number" name="spt_hammer_number" placeholder="Enter SPT Hammer Number" value="{{ isset($bore_hole)? $bore_hole->spt_hammer_number : old('spt_hammer_number') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('spt_hammer_number')}}</p>
                                </div>
                                <!-- end spt_hammer_number field -->

                                <!-- start coring_method field -->
                                <div class="form-group">
                                    <label for="coring_method_id">Coring Method<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="coring_method_id" name="coring_method_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($coring_methods as $coring_method)
                                        <option value="{{$coring_method->id}}" @if($coring_method->id == $bore_hole->coring_method_id) selected @endif>{{$coring_method->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Coring Method </option>
                                        @foreach($coring_methods as $coring_method)
                                        <option value="{{$coring_method->id}}" @if(old('coring_method_id')==$coring_method->id) selected @endif>{{$coring_method->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('coring_method_id')}}</p>
                                </div>
                                <!-- end coring_method field -->

                                <!-- start drilling_fluid field -->
                                <div class="form-group">
                                    <label for="drilling_fluid_id">Drilling Fluid<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="drilling_fluid_id" name="drilling_fluid_id">
                                        @if(isset($bore_hole))
                                        <!-- start options for edit form -->
                                        @foreach($drilling_fluids as $drilling_fluid)
                                        <option value="{{$drilling_fluid->id}}" @if($drilling_fluid->id == $bore_hole->drilling_fluid_id) selected @endif>{{$drilling_fluid->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Drilling Fluid </option>
                                        @foreach($drilling_fluids as $drilling_fluid)
                                        <option value="{{$drilling_fluid->id}}" @if(old('drilling_fluid_id')==$drilling_fluid->id) selected @endif>{{$drilling_fluid->name}}</option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('drilling_fluid_id')}}</p>
                                </div>
                                <!-- end drilling_fluid field -->

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
            //Start Validation for Entry and Edit Form
            $('#bore_hole_form').validate({
                rules: {
                    name: 'required',
                },
                messages: {
                    name: 'Bore hole name is required',
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form


        });

        $('#timepicki').timepicki({
            reset: true
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


        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    </script>
    @endsection
