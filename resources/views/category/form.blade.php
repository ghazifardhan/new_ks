@extends('layouts.app')
@section('content')
<h1>Create New Category</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model(new App\Category, ['class' => 'form-horizontal', 'route' => 'category.store']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="category_name" class='form-control'></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control'></td>
            </tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}</td>
            </tr>       
        </table>    
{!! Form::close() !!}
@endsection