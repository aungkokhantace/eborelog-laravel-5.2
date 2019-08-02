@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($user)? "UPDATE" : "CREATE" }} USER</h4>

                        <!-- start form -->
                        @if(isset($user))
                        <!-- update route -->
                        <form class="forms-sample" id="user_form" method="post" action="/users/{{$user->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}

                            <input type="hidden" name="id" value="{{$user->id}}">
                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="user_form" method="post" action="/users">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="users">

                                <!-- start user name field -->
                                <div class="form-group">
                                    <label for="name">User Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter user name" value="{{ isset($user)? $user->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end user name field -->

                                <!-- start email field -->
                                <div class="form-group">
                                    <label for="email">Email<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' :''}}" id="email" name="email" placeholder="Enter email" value="{{ isset($user)? $user->email : old('email') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                </div>
                                <!-- end email field -->

                                <!-- start 'change password' -->
                                <div class="form-group">
                                    <div class=" form-check form-check-success">
                                        <label class="form-check-label">
                                            @if(isset($user))
                                            Change Password ?
                                            @else
                                            Set Password ? If not checked, <strong>{{$default_password}}</strong> will be used as default password. You can change the default password in <strong>Config</strong>
                                            @endif
                                            <input type="checkbox" id="set_password" name="set_password" class="form-check-input" @if(old("set_password")=="on" ) checked @endif>
                                        </label>
                                    </div>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                </div>

                                <!-- start new password field -->
                                <div class="form-group new_password_field">
                                    <label for="password">New Password<span class="required_field">*</span></label>
                                    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' :''}}" id="password" name="password" placeholder="Enter new password">
                                    <!-- validation error message -->
                                    <p class=" text-danger">{{$errors->first('password')}}</p>
                                </div>
                                <!-- end new password field -->

                                <!-- start confirm new password field -->
                                <div class="form-group new_password_field">
                                    <label for="password_confirmation">Confirm New Password<span class="required_field">*</span></label>
                                    <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' :''}}" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                    <!-- validation error message -->
                                    <p class=" text-danger">{{$errors->first('password_confirmation')}}</p>
                                </div>
                                <!-- end confirm new password field -->
                                <!-- end 'change password' -->

                                <!-- start phone field -->
                                <div class="form-group">
                                    <label for="phone">Phone<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' :''}}" id="phone" name="phone" placeholder="Enter phone" value="{{ isset($user)? $user->phone : old('phone') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('phone')}}</p>
                                </div>
                                <!-- end phone field -->

                                <!-- start nric field -->
                                <div class="form-group">
                                    <label for="nric">NRIC<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('nric') ? 'is-invalid' :''}}" id="nric" name="nric" placeholder="Enter NRIC" value="{{ isset($user)? $user->nric : old('nric') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('nric')}}</p>
                                </div>
                                <!-- end nric field -->

                                <!-- start permit_no field -->
                                <div class="form-group">
                                    <label for="permit_no">Permit Number<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('permit_no') ? 'is-invalid' :''}}" id="permit_no" name="permit_no" placeholder="Enter Permit Number" value="{{ isset($user)? $user->permit_no : old('permit_no') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('permit_no')}}</p>
                                </div>
                                <!-- end permit_no field -->

                                <!-- start nationality_id field -->
                                <div class="form-group">
                                    <label for="nationality">Nationality<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="nationality_id" name="nationality_id">
                                        @if(isset($user))
                                        <!-- start options for edit form -->
                                        @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}" @if($nationality->id == $user->nationality_id) selected @endif>{{$nationality->name}}</option>
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

                                <!-- start role_id field -->
                                <div class="form-group">
                                    <label for="role_id">User Role<span class="required_field">*</span></label>
                                    <select class="form-control black_text" id="role_id" name="role_id">
                                        @if(isset($user))
                                        <!-- start options for edit form -->
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->name}}</option>
                                        @endforeach
                                        <!-- end options for edit form -->

                                        @else
                                        <!-- start options for entry form -->
                                        <option selected disabled> Select User Role </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if(old('role_id')==$role->id) selected @endif>{{$role->name}} </option>
                                        @endforeach
                                        <!-- end options for entry form -->
                                        @endif
                                    </select>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('role_id')}}</p>
                                </div>
                                <!-- end role_id field -->

                                <!-- start buttons -->
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button id="cancel_button" class="btn btn-light">Cancel</button>
                                <!-- end buttons -->
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
            //check on page load, if set_passord is checked, show password fields
            if ($('#set_password').is(":checked")) {
                $(".new_password_field").show();
            }

            //Start Validation for Entry and Edit Form
            $('#user_form').validate({
                rules: {
                    name: 'required',
                    email: 'required',
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    nric: {
                        required: true,
                        number: true
                    },
                    permit_no: {
                        required: true,
                        number: true
                    },
                    nationality_id: 'required',
                    role_id: 'required',
                },
                messages: {
                    name: 'User name is required',
                    email: 'Email is required',
                    password: {
                        required: 'Password is required',
                        minlength: "Password must be at least 6 characters"
                    },
                    password_confirmation: {
                        required: 'Password confirmation is required',
                        equalTo: "Passwords do not match"
                    },
                    phone: {
                        required: 'Phone is required',
                        number: 'Phone must be numeric'
                    },
                    nric: {
                        required: 'NRIC is required',
                        number: 'NRIC must be numeric'
                    },
                    permit_no: {
                        required: 'Permit number is required',
                        number: 'Permit number must be numeric'
                    },
                    nationality_id: 'Nationality is required',
                    role_id: 'Role is required',
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form


        });

        $('#set_password').change(function() {
            if ($('#set_password').is(":checked")) {
                $(".new_password_field").show();
            } else {
                $(".new_password_field").hide();
            }
        });
    </script>
    @endsection
