@extends('layout')

@section('content')


<div class="container">

    @if (Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
    @endif

    <div class="row justify-content-center">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Form Submissions</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td> ID </td>
                            <td> Submitted Date </td>
                            <td> Actions </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                        <tr boarder="none">
                            <td>{{$submission->id}}</td>
                            <td>{{$submission->created_at}}</td>

                            <td>
                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal{{$submission->id}}">View Submission</button>

                                <div id="myModal{{$submission->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Entered Datas</h4>
                                            </div>
                                            <div class="modal-body">

                                                <table>
                                                    <?php foreach ($submission->submittedData as $data) { ?>

                                                        <tr>
                                                            <td><?php echo $data->element->label_name; ?>: <?php echo $data->data; ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



@endsection