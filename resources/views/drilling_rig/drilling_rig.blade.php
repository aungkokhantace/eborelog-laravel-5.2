@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($drilling_rig)? "UPDATE" : "CREATE" }} DRILLING RIG</h4>

                        <!-- start form -->
                        @if(isset($drilling_rig))
                        <!-- update route -->
                        <form class="forms-sample" id="drilling_rig_form" method="post" action="/drilling_rigs/{{$drilling_rig->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" id="id" name="id" value="{{$drilling_rig->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="drilling_rig_form" method="post" action="/drilling_rigs">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="drilling_rigs">

                                <!-- start rig_no field -->
                                <div class="form-group">
                                    <label for="rig_no">Rig No.<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('rig_no') ? 'is-invalid' :''}}" id="rig_no" name="rig_no" placeholder="Enter rig no." value="{{ isset($drilling_rig)? $drilling_rig->rig_no : old('rig_no') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('rig_no')}}</p>
                                </div>
                                <!-- end rig_no field -->

                                <!-- start model field -->
                                <div class="form-group">
                                    <label for="model">Model<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('model') ? 'is-invalid' :''}}" id="model" name="model" placeholder="Enter model" value="{{ isset($drilling_rig)? $drilling_rig->model : old('model') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('model')}}</p>
                                </div>
                                <!-- end model field -->

                                <!-- start year_made field -->
                                <div class="form-group">
                                    <label for="year_made">Year Made<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('year_made') ? 'is-invalid' :''}}" id="year_made" name="year_made" placeholder="Enter Year Made" value="{{ isset($drilling_rig)? $drilling_rig->year_made : old('year_made') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('year_made')}}</p>
                                </div>
                                <!-- end year_made field -->

                                <!-- start lm_cert_no field -->
                                <div class="form-group">
                                    <label for="lm_cert_no">LM Cert No.</label>
                                    <input type="text" class="form-control {{$errors->has('lm_cert_no') ? 'is-invalid' :''}}" id="lm_cert_no" name="lm_cert_no" placeholder="Enter LM Cert No." value="{{ isset($drilling_rig)? $drilling_rig->lm_cert_no : old('lm_cert_no') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('lm_cert_no')}}</p>
                                </div>
                                <!-- end lm_cert_no field -->

                                <!-- start noise_reduce_cylinder field -->
                                <div class="form-group">
                                    <label for="noise_reduce_cylinder">Noise Reduce Cylinder<span class="required_field">*</span></label>
                                    @if(isset($drilling_rig))
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="noise_reduce_cylinder" id="radio_yes" value="Yes" @if($drilling_rig->noise_reduce_cylinder == "Yes") checked @endif>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="noise_reduce_cylinder" id="radio_no" value="No" @if($drilling_rig->noise_reduce_cylinder == "No") checked @endif>
                                            No
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="noise_reduce_cylinder" id="radio_yes" value="Yes" checked>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="noise_reduce_cylinder" id="radio_no" value="No">
                                            No
                                        </label>
                                    </div>
                                    @endif
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('noise_reduce_cylinder')}}</p>
                                </div>
                                <!-- end noise_reduce_cylinder field -->

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
            $('#drilling_rig_forms').validate({
                rules: {
                    rig_no: 'required',
                    model: 'required',
                    year_made: {
                        required: true,
                        number: true
                    },
                },
                messages: {
                    rig_no: 'Rig no. is required',
                    model: 'Model is required',
                    year_made: {
                        required: 'Year made is required',
                        number: 'Year made must be numeric'
                    },
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
    @endsection
