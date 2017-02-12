@extends('layouts.app')
@section('content')
<h1>Invoice</h1>
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
            <th>Invoice Code</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Total</th>
            <th>Invoice Date</th>
            <th>Shipping Date</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($invoice as $row)
        <tr>
            <td>{{$row->invoice_code}}</td>
            <td>{{$row->customer_name}}</td>
            <td>{{$row->customer_phone}}</td>
            <td>{{number_format($row->total,2,',','.')}}</td>
            <td>{{$row->invoice_date}}</td>
            <td>{{$row->shipping_date}}</td>
            <td>{{$row->description}}</td>
            <td>
				<div class="invoiceId display-none">{{$row->invoice_id}}</div>
                <div class="invoiceCode display-none">{{$row->invoice_code}}</div>
				<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle margin-right-1em" type="button" data-toggle="dropdown">Menu
				<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ route('invoice.show', $invoice->id) }}" class="show-btn-invoice">Show Invoice</a></li>
						<li class=""><a href="{{ route('invoice.edit', $invoice->id) }}" class="edit-btn-invoice">Edit Details</a></li>
						<li class=""><a href="{{ route('invoce.destroy', $invoice->id) }}">Delete</a></li>
					</ul>
				<?php
                    if($row->is_paid == '1'){
                ?>
                <button class='btn btn-success unpaid-btn-invoice margin-right-1em' <?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';} ?>>
                    <span class='glyphicon glyphicon-ok'></span> Paid   
                </button>
                <?php
                    } else {
                ?>
                <button class='btn btn-warning paid-btn-invoice margin-right-1em'>
                    <span></span> Unpaid   
                </button>
                <?php
                    }
                ?>
				</div>
                <!-- update button -->
                {!! link_to_route('item.edit', 'Edit', array($row->id), array('class' => 'btn btn-primary dropdown-toggle margin-right-1em', 'data-toggle' => 'dropdown')) !!}
                    
                <!-- delete button -->
                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                </td>
                {!! Form::close() !!} 
            </td>
        </tr>
        @endforeach
    </table>
    <center>
    {{ $invoice->render() }}
    </center>
@endsection