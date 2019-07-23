@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($permission)? "UPDATE" : "CREATE" }} PERMISSION</h4>

                        <!-- start form -->
                        @if(isset($permission))
                        <!-- update route -->
                        <form class="forms-sample" id="permission_form" method="post" action="/permissions/{{$permission->id}}">
                            <!-- form method spoofing -->
                            <input type="hidden" name="_method" value="PUT">
                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="permission_form" method="post" action="/permissions">
                                @endif

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="permissions">

                                <!-- start module name field -->
                                <div class="form-group">
                                    <label for="permission_module_name">Module</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="permission_module_name" name="permission_module_name" placeholder="Enter module name (eg. User/Role/Project)" value="{{ isset($permission)? $permission->module : old('permission_module_name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('permission_module_name')}}</p>
                                </div>
                                <!-- end module name field -->

                                <!-- start action field -->
                                <div class="form-group">
                                    <label for="permission_action">Action</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="permission_action" name="permission_action" placeholder="Enter permission action (eg. List, Create, Store, Show, Edit, Update, Delete)" value="{{ isset($permission)? $permission->action : old('permission_action') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('permission_action')}}</p>
                                </div>
                                <!-- end action field -->

                                <!-- start route name field -->
                                <div class="form-group">
                                    <label for="route_name">Route Name</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="route_name" name="route_name" placeholder="Enter permission route name (eg. role.index, role.create, role.store, role.show, role.edit, role.update, role.destroy)" value="{{ isset($permission)? $permission->route_name : old('route_name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('route_name')}}</p>

                                </div>
                                <!-- end route name field -->

                                <!-- start route method field -->
                                <div class="form-group">
                                    <label for="method">Form Request Method</label>
                                    <select class="form-control {{$errors->has('method') ? 'is-invalid' :''}}" id="method" name="method">
                                        @if(isset($permission))
                                        <option value="get" @if($permission->method == 'get') selected @endif>GET</option>
                                        <option value="post" @if($permission->method == 'post') selected @endif>POST</option>
                                        <option value="put" @if($permission->method == 'put') selected @endif>PUT</option>
                                        <option value="delete" @if($permission->method == 'delete') selected @endif>DELETE</option>
                                        @else
                                        <option selected disabled>Select request method</option>
                                        <option value="get">GET</option>
                                        <option value="post">POST</option>
                                        <option value="put">PUT</option>
                                        <option value="delete">DELETE</option>
                                        @endif
                                    </select>

                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('method')}}</p>
                                </div>
                                <!-- end route method field -->

                                <!-- start description field -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="description" name="description" placeholder="Enter permission description" rows="4">{{ isset($permission)? $permission->description : old('description') }}</textarea>
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('description')}}</p>
                                </div>
                                <!-- end description field -->

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
                    $('input[type="submit"]').attr('disabled', 'disabled');
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
    @endsection
