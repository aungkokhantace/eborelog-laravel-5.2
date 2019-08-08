@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($drilling_company)? "UPDATE" : "CREATE" }} DRILLING COMPANY</h4>

                        <!-- start form -->
                        @if(isset($drilling_company))
                        <!-- update route -->
                        <form class="forms-sample" id="drilling_company_form" method="post" action="/drilling_companies/{{$drilling_company->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}


                            <input type="hidden" id="id" name="id" value="{{$drilling_company->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="drilling_company_form" method="post" action="/drilling_companies">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="drilling_companies">

                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter drilling company name" value="{{ isset($drilling_company)? $drilling_company->name : old('name') }}">
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
            $('#drilling_company_forms').validate({
                rules: {
                    name: 'required',
                },
                messages: {
                    name: 'Drilling company name is required',
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
