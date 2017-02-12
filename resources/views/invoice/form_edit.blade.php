<?php

include_once '../../models/Include.php';

// get invoice code
$invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('Error: Invoice ID not found!');
$invoice->invoiceCode = $invoiceCode;
$stmt = $invoice->readOne();
$row = $stmt->fetch(PDO::FETCH_OBJ);

$voucher->invoiceId = $row->invoice_id;
$voucher->isNotUsed();

?>
	<h1>Update Invoice: <?php echo $row->invoice_code; ?></h1>
	<form id="form_update_invoice" action="javascript://" method="POST" border='0'>
		<input type="hidden" name="invoiceId" value="<?php echo $row->invoice_id;?>">
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Invoice Code</td>
				<td><input type="text" id="invoiceCode" name="invoiceCode" class="form-control" value="<?php echo $row->invoice_code; ?>" readonly/></td>
			</tr>
			<tr>
				<td>Invoice Date</td>
				<td><input type="date" name="invoiceDate" class="form-control" value="<?php echo $row->invoice_date; ?>"/></td>
			</tr>
			<tr>
				<td>Customer Name</td>
				<td><input type="text" name="customerName" class="form-control customerName" value="<?php echo $row->customer_name; ?>"/></td>
			</tr>
			<tr>
				<td>Customer Phone</td>
				<td><input type="text" name="customerPhone" class="form-control" value="<?php echo $row->customer_phone; ?>"/></td>
			</tr>
			<tr>
				<td>Address 1</td>
				<td><input type="text" name="customerAddress" class="form-control" maxlength="50" value="<?php echo $row->customer_address; ?>"/></td>
			</tr>
			<tr>
				<td>Address 2</td>
				<td><input type="text" name="customerAddress2" class="form-control"  maxlength="50" value="<?php echo $row->customer_address_2; ?>"/></td>
			</tr>
			<tr>
				<td>Address 3</td>
				<td><input type="text" name="customerAddress3" class="form-control"  maxlength="50" value="<?php echo $row->customer_address_3; ?>"/></td>
			</tr>
            <tr>
				<td>Payment Method</td>
				<td>
                	<select name="paymentMethod" class="form-control">
						<?php 
						$stmt = $payment->index();
						while($rows = $stmt->fetch(PDO::FETCH_OBJ)){
						?>
						<option value="<?php echo $rows->payment_method_id;?>" 
						<?php if($rows->payment_method_id == $row->payment_method){ echo 'selected';}?>>
						<?php echo $rows->payment_method_name; ?>
						</option>
						<?php } ?>
					</select>
                </td>
            </tr>
            <tr>
				<td>Shipping Date</td>
				<td><input type="date" name="shippingDate" class="form-control" value="<?php echo $row->shipping_date; ?>"/></td>
			</tr>
            <tr>
				<td>Potongan / Voucher</td>
				<td><select id="voucherChooser" data-placeholder="Voucher" name="voucherChooser[]" class="form-control" multiple="multiple" style="width: 300px">
                    </select>
				</td>
</tr><td></td>
				<td><input type="number" name="voucher" value="<?php echo $row->voucher; ?>" class="form-control voucherResult" style="width: 300px"/>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control" value="<?php echo $row->description; ?>"/></td>
			</tr>
				<td>Description 2</td>
				<td><input type="text" name="description2" class="form-control" value="<?php echo $row->description_2; ?>"/></td>
			</tr>
			<tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>	