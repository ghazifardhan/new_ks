@extends('layouts.app')
@section('content')
<br/>
<table>
<tr>
<td>
<div class="invoiceCode display-none"></div>
<?php if($invoice->is_paid == '1')
{
    ?>
    <button class="btn btn-success create-btn-transaction margin-right-1em" disabled><span class='glyphicon glyphicon-ok'></span> Paid</button>
<?php
} else {?>
    <a href="{{ route('invoice.transaction.create', array($invoice->id)) }}" class="btn btn-info"><span class='glyphicon glyphicon-plus'></span>New Transaction</a>
    <!--
    <button type="button" href="{{ route('invoice.transaction.create', array($invoice->id)) }}" class="btn btn-info create-btn-transaction margin-right-1em" <?php if($invoice->is_paid == '1'){ echo 'disabled';}?>><span class='glyphicon glyphicon-plus'></span> New Transaction</button>
    -->
<?php
    }
?>
</td>
<!--
<form action='/nsproject/views/transaction/print_invoice.php' method="post" target="_blank"> -->
<td>
    <form method="get" action="{{ url('print_invoice') }}">
      <div class="invoiceCode display-none"><?php echo $invoice->invoice_code;?></div>
      <input type="hidden" name="invoiceCode" value="<?php echo $invoice->invoice_code;?>" />
      <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice->id;?>" />
      <button type="submit" class="btn btn-danger print-btn-transaction-pdf margin-right-1em"><span class='glyphicon glyphicon-print'></span> Print PDF</button>
    </form>
</td>
<td>
    <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-success"> Edit Invoice</a>
</td>
<!-- </form> -->
</tr>
</table>
<br/>
<table class="table table-striped table-condensed">
    <tr>
        <td>Invoice Code</td>
        <td>: <?php echo $invoice->invoice_code;?></td>
    </tr>
    <tr>
        <td>Customer Name</td>
        <td>: <?php echo $invoice->customer_name;?></td>
    </tr>
    <tr>
        <td>Customer Phone</td>
        <td>: <?php echo $invoice->customer_phone;?></td>
    </tr>
    <tr>
        <td>Address 1</td>
        <td>: <?php echo $invoice->customer_address_1;?></td>
    </tr>
    <tr>
        <td>Address 2</td>
        <td>: <?php echo $invoice->customer_address_2;?></td>
    </tr>
    <tr>
        <td>Address 3</td>
        <td>: <?php echo $invoice->customer_address_3;?></td>
    </tr>
	<tr>
        <td>Payment Method</td>
        <td>: <?php echo $invoice->paymentMethod->name;?></td>
    </tr>
	<tr>
        <td>Invoice Date</td>
        <td>: <?php echo $invoice->invoice_date;?></td>
    </tr>
	<tr>
        <td>Shipping Date</td>
        <td>: <?php echo $invoice->shipping_date;?></td>
    </tr>
    <tr>
        <td>Potongan/Voucher</td>
        <td>: IDR <?php echo number_format($invoice->voucher,0,',','.');?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td>: <?php echo $invoice->description;?></td>
    </tr>
    <tr>
        <td>Description 2</td>
        <td>: <?php echo $invoice->description_2;?></td>
    </tr>
</table>
<br/>
<table class="table table-bordered table-hover table-striped table-condensed table-responsive">
        <tr>
            <th class='col-md-1'>#</th>
            <th class='col-md-1'>Item Name</th>
            <th class='col-md-1'>Qty</th>
            <th class='col-md-1'>Unit</th>
            <th class='col-md-1'>Discount</th>
            <th class='col-md-1'>Potongan</th>
            <th class='col-md-1'>Price</th>
            <th class='col-md-1'>Description</th>
            <th class='col-md-2'>Menu</th>
            <!--<th>Option</th>-->
        </tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' => array('batchdelete', $invoice->id))) !!}
        <?php $x = 1; $total = 0;?>
        @foreach($transaction as $row)
        <?php  $total += $row->item_price;  ?>
        <tr>
            <td class='col-md-1'>{{ $x++ }}</td>
            <td class='col-md-1'><?php echo $row->item_name; ?></td>
            <td class='col-md-1'><?php echo $row->unit_name; ?></td>
            <td class='col-md-1'><?php echo $row->item_qty; ?></td>
            <td class='col-md-1'><?php echo $row->discount; ?></td>
            <td class='col-md-1'><?php echo $row->deduction; ?></td>
            <td class='col-md-1'><?php echo number_format($row->item_price,0,',','.'); ?></td>
			<td class='col-md-2'><?php echo $row->description; ?></td>
			<td><input type="checkbox" name="delete[]" value="{{ $row->id }}"><a href="{{ route('invoice.transaction.edit', [$invoice->id, $row->id]) }}" class="btn btn-info">Edit</a>
			</td>
        </tr>
        @endforeach
		<tr>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'>{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!} </td>
        </tr>
        {!! Form::close() !!}
		<tr>
            <td class='col-md-2' colspan="6"><strong>Total</strong></td>
            <td class='col-md-2'><strong>{{ $total }}</strong></td>
			<td class='col-md-2'></td>
        </tr>
        <tr>
            <td class='col-md-2' colspan="6"><strong>Potongan/Voucher</strong></td>
            <td class='col-md-2'><strong>{{ $invoice->voucher }}</strong></td>
            <td class='col-md-2'></td>
        </tr>
        <tr>
            <td class='col-md-2' colspan="6"><strong>Grand Total</strong></td>
            <td class='col-md-2'><strong>{{ $totalAll = $total - $invoice->voucher }}</td>
            <td class='col-md-2'></td>
        </tr>
    </table>
    <?php

    $invoice->total = $totalAll;
    $invoice->update();

    ?>
    @stop
    @section('script')
    <script>
    /*
    $('.print-btn-transaction-pdf').on('click', function(){
        var id = $('#invoice_id').val();
        $.ajax({
          type: 'GET',
          url: "{{ url('print_invoice') }}",
          data: {invoice_id: id},
          success: function(){
            console.log('test');
          }
        })
    });
    */
    </script>
    @endsection
