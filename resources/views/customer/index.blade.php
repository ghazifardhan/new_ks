@extends('layouts.app')
@section('content')
<h1>customer</h1>
	{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('customer.index'))) !!}
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
            <th>Customer Name</th>
            <th>Customer Type</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($customer as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('customer.destroy', $row->id))) !!}
            <td><a href="{{ route('customer.show', $row->id) }}"><?php echo $row->customer_name; ?></a></td>
            <td><?php if($row->customer_type == '1'){echo 'Regular';} else { echo 'Restaurant';}?></td>
            <td><?php echo $row->description; ?></td>
            <td>
            
            <!-- update button -->
            {!! link_to_route('customer.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) !!}
                
            <!-- delete button -->
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
            </td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
{{ $customer->render() }}
@endsection