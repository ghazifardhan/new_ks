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
    <button class="btn btn-info create-btn-transaction margin-right-1em" <?php if($invoice->is_paid == '1'){ echo 'disabled';}?>><span class='glyphicon glyphicon-plus'></span> New Transaction</button>
<?php    
    }
?>
</td>
<!--
<form action='/nsproject/views/transaction/print_invoice.php' method="post" target="_blank"> -->
<td>
    <div class="invoiceCode display-none"><?php echo $invoice->invoice_code;?></div>
    <input type="hidden" name="invoiceCode" value="<?php echo $invoice->invoice_code;?>" />
    <button type="submit" class="btn btn-danger print-btn-transaction-pdf margin-right-1em"><span class='glyphicon glyphicon-print'></span> Print PDF</button>
</td>
<td>
    <div class="invoiceCode display-none"><?php echo $invoice->invoice_code;?></div>
    <input type="hidden" name="invoiceCode" value="<?php echo $invoice->invoice_code;?>" />
    <button type="submit" class="btn btn-success print-btn-transaction-xls margin-right-1em"><span class='glyphicon glyphicon-print'></span> Print XLS</button>
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
        <td>: <?php echo $invoice->payment_method;?></td>
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
<table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th class='col-md-2'>#</th>
            <th class='col-md-2'>Item Name</th>
            <th class='col-md-2'>Qty</th>
            <th class='col-md-2'>Unit</th>
            <th class='col-md-2'>Discount</th>
            <th class='col-md-2'>Potongan</th>
            <th class='col-md-2'>Price</th>
            <th class='col-md-2'>Description</th>
            <th class='col-md-2'>Menu</th>
            <!--<th>Option</th>-->
        </tr>
        <tr>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
			<td class='col-md-2'></td>
			<td>
			</td>
        </tr>
		<tr>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
        </tr>
		<tr>
            <td class='col-md-2' colspan="6"><strong>Total</strong></td>
            <td class='col-md-2'><strong></td>
			<td class='col-md-2'></td>
        </tr>
        <tr>
            <td class='col-md-2' colspan="6"><strong>Potongan/Voucher</strong></td>
            <td class='col-md-2'><strong></td>
            <td class='col-md-2'></td>
        </tr>
        <tr>
            <td class='col-md-2' colspan="6"><strong>Grand Total</strong></td>
            <td class='col-md-2'><strong></td>
            <td class='col-md-2'></td>
        </tr>
    </table>
    @endsection