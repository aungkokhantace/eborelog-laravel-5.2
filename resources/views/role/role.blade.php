@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($role)? "UPDATE" : "CREATE" }} ROLE</h4>

                        <!-- start form -->
                        @if(isset($role))
                        <!-- update route -->
                        <form class="forms-sample" method="post" action="/roles/{{$role->id}}">
                            @method('PUT')
                            @else
                            <!-- store route -->
                            <form class="forms-sample" method="post" action="/roles">
                                @endif

                                @csrf

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="roles">

                                <!-- start role name field -->
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter role name" value="{{ isset($role)? $role->name : old('name') }}">
                                    <!-- name validation error message -->

                                </div>
                                <!-- end role name field -->

                                <!-- start role description field -->
                                <div class="form-group">
                                    <label for="description">Role Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter role description" rows="4">{{ isset($role)? $role->description : old('description') }}</textarea>
                                    <!-- description validation error message -->

                                </div>
                                <!-- end role description field -->

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
