@extends('layouts.app')
@section('content')
<div class="left">
	<h3>Input Transaction</h3>
	{!! Form::model(new App\Transaction, ['route' => ['invoice.transaction.store', $invoice->id], 'class' => 'form-horizontal']) !!}
        <br/>
        <br/>
        <div id="myTable">
        <div class="panel panel-default">
        <div class="panel-heading">Item 1</div>
        <div class="panel-body">
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Item Name</td>
				<td><select id="item1" data-placeholder="Choose Item" name="item_id[]" class="form-control chosen-select" required>
					<option value=""></option>
					@foreach($item as $row)
					<option value="{{ $row->id }}">{{$row->item_name}}</option>
					@endforeach
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><div id="result1"><div class="input-group"><input type="text" name="item_qty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required/><span class="input-group-addon" id="basic-addon2"></span></div></div></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><div class="input-group"><input type="number" name="discount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2"/>
					<span class="input-group-addon" id="basic-addon2">%</span></div>
				</td>
			</tr>
			<tr>
				<td>Potongan</td>
				<td><input type="number" name="deduction[]" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"/></div>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description[]" class="form-control"/></td>
			</tr>
            
        </table>
        </div></div></div>
        <tr>
            <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            <td><button type="button" class="btn btn-success add-btn-transaction" style="margin-top: -7px; padding: -2px; float: right;"><span class='glyphicon glyphicon-plus'></span> Add Item</button></td>
        </tr>
    {!! Form::close() !!}
</div>
@endsection