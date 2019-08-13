@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($coring_method)? "UPDATE" : "CREATE" }} CORING METHOD</h4>

                        <!-- start form -->
                        @if(isset($coring_method))
                        <!-- update route -->
                        <form class="forms-sample" id="coring_method_form" method="post" action="/coring_methods/{{$coring_method->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" id="id" name="id" value="{{$coring_method->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="coring_method_form" method="post" action="/coring_methods">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="coring_methods">

                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter name" value="{{ isset($coring_method)? $coring_method->name : old('name') }}">
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
            $('#coring_method_form').validate({
                rules: {
                    name: 'required',
                },
                messages: {
                    name: 'Name is required',
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
