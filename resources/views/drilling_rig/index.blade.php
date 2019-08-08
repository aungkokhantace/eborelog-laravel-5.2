@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">DRILLING RIG LIST</h4>
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
                                <a href="/drilling_rigs/create">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Create a new drilling rig">
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
                                        <th>Rig No.</th>
                                        <th>Model</th>
                                        <th>Year Made</th>
                                        <th>LM Cert No.</th>
                                        <th>Noise reduce cylinder</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($drilling_rigs as $drilling_rig)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $drilling_rig->rig_no }}</td>
                                        <td>{{ $drilling_rig->model }}</td>
                                        <td>{{ $drilling_rig->year_made }}</td>
                                        <td>{{ $drilling_rig->lm_cert_no }}</td>
                                        <td>{{ $drilling_rig->noise_reduce_cylinder }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/drilling_rigs/{{$drilling_rig->id}}/edit"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit this drilling rig"><i class="mdi mdi-pencil"></i></button></a>
                                                <form class="delete_form" action="/drilling_rigs/{{$drilling_rig->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <!-- form method spoofing -->
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger delete_button" data-toggle="tooltip" data-placement="top" title="Delete this drilling rig">
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
