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
                        <form class="forms-sample" method="post" action="/permissions/{{$permission->id}}">
                            @method('PUT')
                            @else
                            <!-- store route -->
                            <form class="forms-sample" method="post" action="/permissions">
                                @endif

                                @csrf

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="permissions">

                                <!-- start module name field -->
                                <div class="form-group">
                                    <label for="permission_module_name">Module</label>
                                    <input type="text" class="form-control  @error('permission_module_name') is-invalid @enderror" id="permission_module_name" name="permission_module_name" placeholder="Enter module name (eg. User/Role/Project)" value="{{ isset($permission)? $permission->module : old('permission_module_name') }}">
                                    <!-- module name validation error message -->
                                    @error('permission_module_name')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- end module name field -->

                                <!-- start action field -->
                                <div class="form-group">
                                    <label for="permission_action">Action</label>
                                    <input type="text" class="form-control  @error('permission_action') is-invalid @enderror" id="permission_action" name="permission_action" placeholder="Enter permission action (eg. List, Create, Store, Show, Edit, Update, Delete)" value="{{ isset($permission)? $permission->action : old('permission_action') }}">
                                    <!-- permission action validation error message -->
                                    @error('permission_action')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- end action field -->

                                <!-- start route name field -->
                                <div class="form-group">
                                    <label for="route_name">Route Name</label>
                                    <input type="text" class="form-control  @error('route_name') is-invalid @enderror" id="route_name" name="route_name" placeholder="Enter permission route name (eg. role.index, role.create, role.store, role.show, role.edit, role.update, role.destroy)" value="{{ isset($permission)? $permission->route_name : old('route_name') }}">
                                    <!-- url validation error message -->
                                    @error('route_name')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- end route name field -->

                                <!-- start route method field -->
                                <div class="form-group">
                                    <label for="method">Request Method</label>
                                    <input type="text" class="form-control  @error('method') is-invalid @enderror" id="method" name="method" placeholder="Enter request method (eg. get, post, put, delete)" value="{{ isset($permission)? $permission->method : old('method') }}">
                                    <!-- url validation error message -->
                                    @error('method')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- end route method field -->

                                <!-- start description field -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter permission description" rows="4">{{ isset($permission)? $permission->description : old('description') }}</textarea>
                                    <!-- description validation error message -->
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
