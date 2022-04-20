@extends('layout')

@section('content')


<div class="container">

    @if (Session::has('message'))
    <div class="alert alert-info">
        <ul>
            <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
    @endif


    <div class="row justify-content-center">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Forms</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td> ID </td>
                            <td> Form Name </td>
                            <td> Actions </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($forms as $form)
                        <tr boarder="none">
                            <td>{{$form->id}}</td>
                            <td>{{$form->name}}</td>

                            <td>
                                <a class="btn btn-warning" href="{{ route('forms.edit',['id' => $form->id])}}">Edit Form</a>
                                <a class="btn btn-info" href="{{ route('public.forms.show',['id' => $form->id])}}">Fill Form Publically</a>
                                <a class="btn btn-success" href="{{ route('forms.submissions',['id' => $form->id])}}">View Form Submissions</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {!! $forms->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection