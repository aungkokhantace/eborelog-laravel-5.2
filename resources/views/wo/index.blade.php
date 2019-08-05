@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">WO LIST</h4>
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
                                        <th>Project</th>
                                        <th>WO Number</th>
                                        <th>Number of BH</th>
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
                                        <td>{{ $wo->project_id }}</td>
                                        <td>{{ $wo->wo_number }}</td>
                                        <td>{{ $wo->number_of_bh }}</td>
                                        <td>{{ $wo->wo_start_date }}</td>
                                        <td>{{ $wo->wo_completion_date }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/wo/{{$wo->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this wo"><i class="mdi mdi-pencil"></i></button></a>
                                                <form class="delete_form" action="/wo/{{$wo->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this wo">
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
