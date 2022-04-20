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
                <h3>Forms</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td> ID </td>
                            <td> First Name </td>
                            <td> Last Name </td>
                            <td> email </td>
                            <td> company </td>
                            <td colspan="2"> Actions </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr boarder="none">
                            <td>{{$employee->id}}</td>
                            <td>{{$employee->first_name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->company->name}}</td>
                            <td>
                                <form action="{{ route('employee.destroy',['id' => $employee->id])}}" method="post">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('employee.edit',['id' => $employee->id])}}">Edit</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {!! $employees->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection