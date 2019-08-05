@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">EDIT CONFIG</h4>

                        <!-- start alert -->
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- end alert -->

                        <form class="forms-sample" id="config_form" method="post" action="/config">

                            {{ csrf_field() }}

                            <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                            <input type="hidden" id="module" name="module" value="config">

                            <!-- start default_user_password field -->
                            <div class="form-group">
                                <label for="default_user_password">Default user password<span class="required_field">*</span></label>
                                <input type="text" class="form-control {{$errors->has('default_user_password') ? 'is-invalid' :''}}" id="default_user_password" name="default_user_password" placeholder="Enter default user password" value="{{ isset($config)? $config["default_user_password"] : old("default_user_password") }}">
                                <!-- validation error message -->
                                <p class="text-danger">{{$errors->first("default_user_password")}}</p>
                            </div>
                            <!-- end default_user_password field -->

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
            $('#permission_form').validate({
                rules: {
                    permission_module_name: 'required',
                    permission_action: 'required',
                    route_name: 'required',
                    method: 'required',
                },
                messages: {
                    permission_module_name: 'Module name is required',
                    permission_action: 'Action is required',
                    route_name: 'Route name is required',
                    method: 'Form request method is required',
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
