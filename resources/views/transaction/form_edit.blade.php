@extends('layouts.app')
@section('content')
<div class="left">
	<h1>Edit Transaction:</h1>
	{!! Form::model($transaction, ['method' => 'PATCH', 'route' => ['invoice.transaction.update', $invoice->id, $transaction->id], 'class' => 'form-horizontal']) !!}
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Item Name</td>
				<td><select id="item1" data-placeholder="Choose Item" name="item_id" class="form-control chosen-select" required>
                    <option value=""></option>
                    @foreach($item as $row)
                    <option value="<?php echo $row->id; ?>" <?php if($row->id == $transaction->item_id){ echo 'selected';}?>><?php echo $row->item_name; ?></option>
                    @endforeach
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><div id="result1"><div class="input-group"><input type="text" name="item_qty" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control"  value="<?php echo $transaction->item_qty; ?>" required/><span class="input-group-addon" id="basic-addon2"><?php echo $transaction->unit_name; ?></span></div></div></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><div class="input-group"><input type="number" name="discount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2" value="<?php echo $transaction->discount; ?>"/>
					<span class="input-group-addon" id="basic-addon2">%</span></div>
				</td>
			</tr>
			<tr>
				<td>Potongan</td>
				<td><input type="number" name="deduction" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" value="<?php echo $transaction->deduction; ?>"/></div>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control"  value="<?php echo $transaction->description; ?>"/></td>
			</tr>
			<tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>
</div>
@stop
@section('script')
@endsection