@extends('layouts.app')
@section('content')
<h1>Create New Unit</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model($unit, ['method' => 'PATCH', 'route' => ['unit.update', $unit->id], 'class' => 'form-horizontal']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Unit Name</td>
                <td><input type="text" name="unit_name" class='form-control' value="{{ $unit->unit_name }}"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="{{ $unit->description }}"></td>
            </tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}</td>
            </tr>       
        </table>    
{!! Form::close() !!}
@endsection