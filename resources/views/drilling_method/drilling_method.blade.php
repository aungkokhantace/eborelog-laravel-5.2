@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($drilling_method)? "UPDATE" : "CREATE" }} DRILLING METHOD</h4>

                        <!-- start form -->
                        @if(isset($drilling_method))
                        <!-- update route -->
                        <form class="forms-sample" id="drilling_method_form" method="post" action="/drilling_methods/{{$drilling_method->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" id="id" name="id" value="{{$drilling_method->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="drilling_method_form" method="post" action="/drilling_methods">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="drilling_methods">

                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter name" value="{{ isset($drilling_method)? $drilling_method->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end name field -->

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
            $('#drilling_method_form').validate({
                rules: {
                    name: 'required',
                    model: 'required',
                    year_made: {
                        required: true,
                        number: true
                    },
                },
                messages: {
                    name: 'Rig no. is required',
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
