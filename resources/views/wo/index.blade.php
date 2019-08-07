@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- get projet name by project_id -->
                        <?php $project_name = App\Core\Utility::getProjectNameByID($project_id) ?>

                        <h4 class="card-title">WO LIST for {{ $project_name }}</h4>
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
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 float-left">
                                <a href="/projects">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Go back to project list">
                                        <i class="mdi mdi-arrow-left-bold"></i> Project List
                                    </button>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 float-right ml-auto">
                                <a href="/wo/{{$project_id}}/create">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Create a new wo">
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
                                        <th>WO Number</th>
                                        <th>Number of BH</th>
                                        <th>Location</th>
                                        <th>Start Date</th>
                                        <th>Completion Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($wos as $wo)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $wo->wo_number }}</td>
                                        <td>{{ $wo->number_of_bh }}</td>
                                        <td>{{ $wo->location }}</td>
                                        <td>{{ date('d-m-Y', strtotime($wo->wo_start_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($wo->wo_completion_date)) }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <!-- start view detail button -->
                                                <a href="/wo/{{$project_id}}/{{$wo->id}}"><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View detail"><i class="mdi mdi-file-document-box"></i></button></a>
                                                <!-- end view detail button -->

                                                <!-- start edit button -->
                                                <a href="/wo/{{$project_id}}/{{$wo->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this wo"><i class="mdi mdi-pencil"></i></button></a>
                                                <!-- end edit button -->

                                                <!-- start delete button -->
                                                <form class="delete_form" action="/wo/{{$project_id}}/{{$wo->id}}/destroy" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this wo">
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
