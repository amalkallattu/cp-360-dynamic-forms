@extends('layout')

@section('content')

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $error }}</strong>
</div>
@endforeach
@endif


<div style="display:none">
    <div class="form-group base_element" id="base_element">

        <div class="panel panel-default">
            <div class="panel-body">

                <label for="remove_element">Select Element:</label>
                <a class="btn remove_element" name="remove_element">Remove Element</a>

                <select class="form-control element-selectbox" name="element_id[]" required>
                    <option>Select</option>
                    @foreach($inputTypes as $inputType)
                    <option value="{{$inputType->id}}">{{$inputType->name}}</option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="element_label">Input Label</label>
                    <input type="text" class="form-control" name="element_label[]">
                </div>

                <div class="form-group">
                    <label for="element_label">Required ? </label> <br>

                    <select class="form-control" name="is_required[]">
                        <option value="1">Required</option>
                        <option value="0">Not Required</option>
                    </select>
                </div>

                <div class="form-group form_element_options" style="display: none;">
                    <label for="company">Add Options:</label>( Comma seperated )
                    <input type="text" class="form-control element_option" name="element_options[]">
                </div>

                <div class="errorText">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3>Edit Form - {{$form->name}} </h3>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('forms.update',['id' => $form->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name"> Form Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$form->name}}" required />
                    </div>
                    <a class="btn" name="add_element" id="add_element">ADD ELEMENT</a>

                    <div class="form-group" id="extended_elements">

                        @foreach($form->elements as $elements)

                        <div class="form-group base_element" id="base_element">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <input type="hidden" name="form_element_id[]" value="{{$elements->id}}">

                                    <label for="remove_element">Select Element:</label>
                                    <a class="btn remove_element" onclick="addOldId('{{$elements->id}}');" name="remove_element">Remove Element</a>

                                    <select class="form-control element-selectbox" name="element_id[]" required>
                                        <option>Select</option>
                                        @foreach($inputTypes as $inputType)
                                        <option {{($elements->inputType->id == $inputType->id)?"selected":""}} value="{{$inputType->id}}">{{$inputType->name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <label for="element_label">Input Label</label>
                                        <input type="text" class="form-control" value="{{$elements->label_name}}" name="element_label[]">
                                    </div>

                                    <div class="form-group">
                                        <label for="element_label">Required ? </label> <br>

                                        <select class="form-control" name="is_required[]">
                                            <option {{($elements->required)?"selected":""}} value="1">Required</option>
                                            <option {{($elements->required)?"":"selected"}} value="0">Not Required</option>
                                        </select>
                                    </div>

                                    <div class="form-group form_element_options" style='display: {{($elements->inputType->slug == "select-box")?"block":"none"}} ;'>
                                        <label for="company">Add Options:</label>( Comma seperated )
                                        <input type="text" class="form-control element_option" value="{{implode(',',$elements->options->pluck('option')->toArray())}}" name="element_options[]">
                                    </div>

                                    <div class="errorText">
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-success ">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function addOldId(id) {

        $('#extended_elements').append('<input type="hidden" name="removed_ids[]" value="' + id + '" />');

    }
    $("#add_element").click(function(e) {
        $('#base_element').clone().appendTo('#extended_elements');
    });

    $('body').on('click', '.remove_element', function() {
        $(this).closest("div.base_element").remove();


    });

    $('body').on('change', '.element-selectbox', function() {
        var thisVal = $(this);
        var selected = thisVal.find(":selected").text();
        if (selected == "Select Box") {
            thisVal.parents('div').children("div.form_element_options").show();
        } else {
            thisVal.parents('div').children("div.form_element_options").children("input").val("");
            thisVal.parents('div').children("div.form_element_options").hide();
        }
    });
</script>

@endsection