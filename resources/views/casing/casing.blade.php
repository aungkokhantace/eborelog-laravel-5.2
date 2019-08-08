@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($casing)? "UPDATE" : "CREATE" }} CASING</h4>

                        <!-- start form -->
                        @if(isset($casing))
                        <!-- update route -->
                        <form class="forms-sample" id="casing_form" method="post" action="/casings/{{$casing->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}


                            <input type="hidden" id="id" name="id" value="{{$casing->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="casing_form" method="post" action="/casings">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="casings">

                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter casing name" value="{{ isset($casing)? $casing->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end name field -->

                                <!-- start od field -->
                                <div class="form-group">
                                    <label for="name">OD(mm)<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('od') ? 'is-invalid' :''}}" id="od" name="od" placeholder="Enter OD(mm)" value="{{ isset($casing)? $casing->od : old('od') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('od')}}</p>
                                </div>
                                <!-- end od field -->

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
            $('#casing_form').validate({
                rules: {
                    name: 'required',
                    od: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    name: 'Casing name is required',
                    od: {
                        required: 'OD(mm) is required',
                        number: 'OD(mm) must be numeric'
                    }
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
