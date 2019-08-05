@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ROLE LIST</h4>
                        <!-- start alert -->
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- end alert -->

                        <!-- start add new button -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 float-right ml-auto" data-toggle="tooltip" data-placement="top" title="Create a new role">
                                <a href="/roles/create">
                                    <button type="button" class="btn btn-primary">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- end add new button -->

                        <div class="table-responsive pt-3">
                            <!-- start table -->
                            <table class="table table-bordered table-striped list-view-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <!-- start role permission button -->
                                                <a href="/roles/{{$role->id}}/edit_permissions"><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Update permissions for this role"><i class="mdi mdi-account-key"></i></button></a>
                                                <!-- end role permission button -->

                                                <!-- start edit button -->
                                                <a href="/roles/{{$role->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this role"><i class="mdi mdi-pencil"></i></button></a>
                                                <!-- end edit button -->

                                                <!-- start delete button -->
                                                <form class="delete_form" action="/roles/{{$role->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this role">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                                <!-- end delete button -->
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection
