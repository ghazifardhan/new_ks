@extends('layouts.app')
@section('content')
<h1>Category</h1>
{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('category.index'))) !!}
	<div class="input-group">
      <input type="text" name="query" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button type="submit" class="btn btn-default">Search</button>
	  </span>
    </div><!-- /input-group -->
    {!! Form::close() !!}
    <br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Category Name</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($category as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('category.destroy', $row->id))) !!}
            <td>{{ $row->category_name }}</td>
            <td>{{ $row->description }}</td>
            <td>
            <div class="categoryId display-none"></div>
            
            <!-- update button -->
            {!! link_to_route('category.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) !!}
                
            <!-- delete button -->
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}  
            </td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
    <center>
    {{ $category->render() }}
    </center>
@endsection