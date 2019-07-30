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
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Enter user name" value="{{ isset($user)? $user->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end user name field -->

                                <!-- start email field -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' :''}}" id="email" name="email" placeholder="Enter email" value="{{ isset($user)? $user->email : old('email') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                </div>
                                <!-- end email field -->

                                <!-- start phone field -->
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' :''}}" id="phone" name="phone" placeholder="Enter phone" value="{{ isset($user)? $user->phone : old('phone') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('phone')}}</p>
                                </div>
                                <!-- end phone field -->

                                <!-- start nric field -->
                                <div class="form-group">
                                    <label for="nric">NRIC</label>
                                    <input type="text" class="form-control {{$errors->has('nric') ? 'is-invalid' :''}}" id="nric" name="nric" placeholder="Enter NRIC" value="{{ isset($user)? $user->nric : old('nric') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('nric')}}</p>
                                </div>
                                <!-- end nric field -->

                                <!-- start permit_no field -->
                                <div class="form-group">
                                    <label for="permit_no">Permit Number</label>
                                    <input type="text" class="form-control {{$errors->has('permit_no') ? 'is-invalid' :''}}" id="permit_no" name="permit_no" placeholder="Enter Permit Number" value="{{ isset($user)? $user->permit_no : old('permit_no') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('permit_no')}}</p>
                                </div>
                                <!-- end permit_no field -->

                                <!-- start nationality_id field -->
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
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
                                    <label for="role_id">User Role</label>
                                    <select class="form-control black_text" id="role_id" name="role_id">
                                        @if(isset($user))
                                        <!-- start options for edit form -->
                                        @foreach($roles as $role)
                                        <option value="{{$user->role_id}}" @if($role->id == $user->role_id) selected @endif>{{$role->name}}</option>
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
            //Start Validation for Entry and Edit Form
            $('#user_form').validate({
                rules: {
                    name: 'required',
                    email: 'required',
                    phone: 'required',
                    nric: 'required',
                    permit_no: 'required',
                    nationality_id: 'required',
                    role_id: 'required',
                },
                messages: {
                    name: 'User name is required',
                    email: 'Email is required',
                    phone: 'Phone is required',
                    nric: 'NRIC is required',
                    permit_no: 'Permit number is required',
                    nationality_id: 'Nationality is required',
                    role_id: 'Role is required',
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled', 'disabled');
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
    @endsection
