@extends('layouts.app')
@section('content')
<h1>Update Highlight</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model($highlight, ['method' => 'PATCH', 'route' => ['highlight.update', $highlight->id], 'class' => 'form-horizontal']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Highlight Name</td>
                <td><input type="text" name="highlight_name" class='form-control' value="{{$highlight->highlight_name}}"></td>
            </tr>
            <tr>
                <td>Highlight Color</td>
                <td><input type="text" name="highlight_color" class='form-control' value="{{$highlight->highlight_color}}"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="{{$highlight->description}}"></td>
            </tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}</td>
            </tr>       
        </table>  
{!! Form::close() !!}
@endsection