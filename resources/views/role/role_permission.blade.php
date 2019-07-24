@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PERMISSION LIST FOR {{strtoupper($role->name)}}</h4>
                        <!-- start alert -->
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- end alert -->

                        <div class="table-responsive pt-3">
                            <form action="/roles/{{$role->id}}/update_permissions" method="post" id="assign_role_permission" name="assign_role_permission">

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="roles">

                                <!-- start table -->
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Has Access?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                        @foreach($all_permissions as $all_permission)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $all_permission->module }}</td>
                                            <td>{{ $all_permission->description }}</td>
                                            <td>
                                                <div class=" form-check form-check-success">
                                                    <label class="form-check-label">
                                                        <input type="hidden" name="permission_checked_{{$all_permission->id}}" value="">
                                                        <input type="checkbox" name="permission_checked_{{$all_permission->id}}" class="form-check-input" @if($all_permission->checked) checked @endif>
                                                    </label>
                                                </div>
                                            </td>
                        </div>
                        </td>
                        </tr>
                        <?php $counter++; ?>
                        @endforeach
                        </tbody>
                        </table>
                        <!-- end table -->

                        <!-- start buttons -->
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button id="cancel_button" class="btn btn-light">Cancel</button>
                        <!-- end buttons -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection
