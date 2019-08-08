@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">CASING LIST</h4>
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
                                <a href="/casings/create">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Create a new casing">
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
                                        <th>OD(mm)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($casings as $casing)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $casing->name }}</td>
                                        <td>{{ $casing->od }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/casings/{{$casing->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this casing"><i class="mdi mdi-pencil"></i></button></a>
                                                <form class="delete_form" action="/casings/{{$casing->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this casing">
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
