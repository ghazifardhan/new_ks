@extends('layouts.app')
@section('content')
<h1>Item</h1>
	{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('item.index'))) !!}
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
            <th>Item Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Subunit</th>
            <th>Price</th>
            <th>Highlight</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($item as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('item.destroy', $row->id))) !!}
            <td>{{$row->item_name}}</td>
            <td>{{$row->category_name}}</td>
            <td>{{$row->unit_name}}</td>
            <td>{{$row->onqty}}</td>
            <td>{{number_format($row->price,0,',','.')}}</td>
            <td>{{$row->highlight_name}}</td>
            <td>{{$row->description}}</td>
            <td>
                <div class="itemId display-none"></div>

                <!-- update button -->
                {!! link_to_route('item.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) !!}
                    
                <!-- delete button -->
                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                </td>
                {!! Form::close() !!}   
            </td>
        </tr>
        @endforeach
    </table>
    <center>
    {{ $item->render() }}
    </center>
    @endsection