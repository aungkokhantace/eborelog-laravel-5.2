@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PROJECT LIST</h4>
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
                                <a href="/projects/create">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Create a new project">
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
                                        <th>Project ID</th>
                                        <th>Project Name</th>
                                        <th>Client</th>
                                        <th>Has WO?</th>
                                        <th>Go To</th>
                                        <th>Notes</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $project->project_id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->client_name }}</td>
                                        <td>
                                            @if($project->has_wo)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                            @if($project->has_wo)
                                            WO List
                                            @else
                                            BH List
                                            @endif
                                        </td>
                                        <td>{{ $project->notes }}</td>
                                        <td>
                                            <!-- start button group -->
                                            <div class=" btn-group float-right" role="group">
                                                <!-- start role permission button -->
                                                <a href="/projects/{{$project->id}}"><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View detail"><i class="mdi mdi-file-document-box"></i></button></a>
                                                <!-- end role permission button -->

                                                <a href="/projects/{{$project->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this project"><i class="mdi mdi-pencil"></i></button></a>

                                                <form class="delete_form" action="/projects/{{$project->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this project">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- end button group -->
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
