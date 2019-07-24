@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PERMISSION LIST</h4>
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
                            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 float-right ml-auto">
                                <a href="/permissions/create">
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
                                        <th>Module</th>
                                        <th>Action</th>
                                        <th>Route Name</th>
                                        <th>Method</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $permission->module }}</td>
                                        <td>{{ $permission->action }}</td>
                                        <td>{{ $permission->route_name }}</td>
                                        <td>{{ $permission->method }}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/permissions/{{$permission->id}}/edit"><button type="button" class="btn btn-secondary"><i class="mdi mdi-pencil"></i></button></a>
                                                <form class="delete_form" action="/permissions/{{$permission->id}}" method="post">
                                                    <!-- form method spoofing -->
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                    <button type="submit" class="btn btn-danger delete_button">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
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
