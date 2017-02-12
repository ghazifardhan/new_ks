@extends('layouts.app')
@section('content')
<h1>Highlight</h1>
	{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('highlight.index'))) !!}
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
            <th>Highlight Name</th>
            <th>Highlight Color</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($highlight as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('highlight.destroy', $row->id))) !!}
            <td>{{ $row->highlight_name }}</td>
            <td>{{ $row->highlight_color }}</td>
            <td>{{ $row->description }}</td>
            <td>
            <div class="highlightId display-none"></div>
            
            <!-- update button -->
            {!! link_to_route('highlight.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) !!}
                
            <!-- delete button -->
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
            </td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
    <center>
    {{ $highlight->render() }}
    </center>
    <center>
    {{ $highlight->render() }}
    </center>
@endsection