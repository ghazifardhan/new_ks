@extends('layouts.app')
@section('content')
<h1>Create New Invoice</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<?php



?>
{!! Form::model(new App\Invoice, ['class' => 'form-horizontal', 'route' => 'invoice.store']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
				<td>Invoice Code</td>
				<td><input type="text" id="invoiceCode" name="invoice_code" class="form-control" value="{{ $invoiceTransform }}" readonly/></td>
			</tr>
			<tr>
				<td>Invoice Date</td>
				<td><input type="date" name="invoice_date" class="form-control"/></td>
			</tr>
			<tr>
				<td>Customer Name</td>
				<td><input type="text" name="customer_name" class="form-control customerName"/></td>
			</tr>
			<tr>
				<td>Customer Phone</td>
				<td><input type="text" name="customer_phone" class="form-control"/></td>
			</tr>
			<tr>
				<td>Address 1</td>
				<td><input type="text" name="customer_address_1" class="form-control" maxlength="40" placeholder="Jalan, RT/RW, No Rumah"/></td>
			</tr>
			<tr>
				<td>Address 2</td>
				<td><input type="text" name="customer_address_2" class="form-control" maxlength="40" placeholder="Kecamatan, Kelurahan"/></td>
			</tr>
			<tr>
				<td>Address 3</td>
				<td><input type="text" name="customer_address_3" class="form-control" maxlength="40" placeholder="Kota"/></td>
			</tr>
            <tr>
				<td>Payment Method</td>
				<td>
                <select name="payment_method" class="form-control" required>
	                    @foreach($paymentMethod as $pm)
	                    <option value="<?php echo $pm->id;?>"><?php echo $pm->name;?></option>
	                    @endforeach
                </select>
                </td>
            </tr>
            <tr>
				<td>Shipping Date</td>
				<td><input type="date" name="shipping_date" class="form-control" required/></td>
			</tr>
            <tr>
				<td>Potongan/Voucher</td>
				<td><select id="voucherChooser" data-placeholder="Voucher" name="voucher_chooser[]" class="form-control" multiple="multiple" style="width: 300px">
                    </select>
                    </td>
			</tr>
<tr>
				<td></td>
				<td>
                    <input type="number" name="voucher" class="form-control voucherResult" style="width: 300px"/>
                    </td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control" /></td>
			</tr>
			<tr>
				<td>Description 2</td>
				<td><input type="text" name="description_2" class="form-control" /></td>
			</tr>
			<tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>
        {!! Form::close() !!}
        @endsection