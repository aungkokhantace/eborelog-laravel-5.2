@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($driller)? "UPDATE" : "CREATE" }} DRILLER</h4>

                        <!-- start form -->
                        @if(isset($driller))
                        <!-- update route -->
                        <form class="forms-sample" id="driller_form" method="post" action="/drillers/{{$driller->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" id="id" name="id" value="{{$driller->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="driller_form" method="post" action="/drillers">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="drillers">


                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter driller name" value="{{ isset($driller)? $driller->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end name field -->

                                <!-- start nric field -->
                                <div class="form-group">
                                    <label for="nric">NRIC<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('nric') ? 'is-invalid' :''}}" id="nric" name="nric" placeholder="Enter NRIC" value="{{ isset($driller)? $driller->nric : old('nric') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('nric')}}</p>
                                </div>
                                <!-- end nric field -->

                                <!-- start permit_no field -->
                                <div class="form-group">
                                    <label for="permit_no">Permit Number<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('permit_no') ? 'is-invalid' :''}}" id="permit_no" name="permit_no" placeholder="Enter Permit Number" value="{{ isset($driller)? $driller->permit_no : old('permit_no') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('permit_no')}}</p>
                                </div>
                                <!-- end permit_no field -->

                                <!-- start nationality_id field -->
                                <div class="form-group">
                                    <label for="nationality">Nationality<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="nationality_id" name="nationality_id">
                                        @if(isset($driller))
                                        <!-- start options for edit form -->
                                        @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}" @if($nationality->id == $driller->nationality_id) selected @endif>{{$nationality->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->
                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select Nationality </option>
                                        @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}" @if(old('nationality_id')==$nationality->id) selected @endif>{{$nationality->name}} </option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('nationality_id')}}</p>
                                </div>
                                <!-- end nationality_id field -->


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
            $('#driller_form').validate({
                rules: {
                    name: 'required',
                    nric: {
                        required: true,
                        number: true
                    },
                    permit_no: {
                        required: true,
                        number: true
                    },
                    nationality_id: 'required',
                },
                messages: {
                    name: 'Driller name is required',
                    nric: {
                        required: 'NRIC is required',
                        number: 'NRIC must be numeric'
                    },
                    permit_no: {
                        required: 'Permit number is required',
                        number: 'Permit number must be numeric'
                    },
                    nationality_id: 'Nationality is required',
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
