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
                <h3>{{$formData->name}}</h3>
            </div>
            <div class="panel-body">

                <form action="{{ route('public.forms.store') }}" method="post">

                    @csrf

                    <input type="hidden" name="form_id" value="{{$formData->id}}">


                    @foreach($formData->elements as $elements)

                    <div class="form-group">
                        <label for="name">{{$elements->label_name}}:</label>

                        @if($elements->inputType->slug == 'text-box')
                        <input type="text" class="form-control" name="dynamic_element_{{$elements->id}}" {{($elements->required)?"required":""}} />
                        @endif

                        @if($elements->inputType->slug == 'number')
                        <input type="number" class="form-control" name="dynamic_element_{{$elements->id}}" {{($elements->required)?"required":""}} />
                        @endif

                        @if($elements->inputType->slug == 'select-box')
                        <select class="form-control" name="dynamic_element_{{$elements->id}}" {{($elements->required)?"required":""}}>
                            <option>Select value</option>
                            @foreach($elements->options as $option)
                            <option value="{{$option->option}}">{{$option->option}}</option>
                            @endforeach
                        </select>
                        @endif

                    </div>

                    @endforeach

                    <div class="form-group">

                        <input type="submit" name="form_submit" class="btn btn-success">

                    </div>

                </form>


            </div>
        </div>
    </div>
</div>



@endsection