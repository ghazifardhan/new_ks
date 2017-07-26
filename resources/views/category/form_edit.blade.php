@extends('layouts.app')
@section('content')
<h1>Update Category</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model($category, ['method' => 'PATCH', 'route' => ['category.update', $category->id], 'class' => 'form-horizontal']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="category_name" class='form-control' value="{{ $category->category_name }}"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="{{ $category->description }}"></td>
            </tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}</td>
            </tr>       
        </table>    
{!! Form::close() !!}
@endsection