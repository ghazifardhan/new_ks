<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>
<style type="text/css">
    table {
        /*font-family: arial, sans-serif;*/
        border-collapse: collapse;
        width: 100%;
    }

    .test {
        border: 2px solid #84C126;
        text-align: left;
        padding: 4px;
        font-size: 11px;
    }
    .test2 {
        border-top: 2px solid #84C126;
        border-right: 2px solid #84C126;
        border-bottom: 2px solid #84C126;
        font-size: 11px;
    }
    .tdwidth {
        width: 100px;
    }
    .tdwidth2 {
        width: 10px;
    }
    .tdwidth3 {
        width: 150px;
    }
    .tdwidth4 {
        width: 30px;
    }
    .topleft {
      vertical-align: top;
      text-align: left;
    }
    .align {
        text-align: right;
    }
    #footer {
        position: absolute;
        bottom: 0;
        text-align: center;
    }
    #margin {
        margin-left: 8px;
    }
    #margin2 {
        margin-left: 8px;
        font-size: 11px;
    }
    .bold {
        font-weight: bold;
    }
    .fontSize {
        font-size: 11px;
    }
    @media print {
    footer {page-break-after: always;}
    }
    @media print
    {
     #not-print { display: none; }
    }
    p {
        font-size: 11px;
    } 
</style>
</head>
<body>

<div id="not-print">
    <input type="button" onclick="javascript:window.print();" value="Print">
    </div>
<?php for($x=0;$x<count($data);$x++){  ?>
<page>
    <img src="https://s17.postimg.org/nnp4f9dan/excell2333.jpg" width="500" height="100"/>
    <br/>
    <br/>
    <div id="margin">
    <table>
    <tr>
        <td class="bold fontSize" style="width: 170px;">No. Invoice</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td class="fontSize"><?php echo $data[$x]['invoice_code']; ?></td>
    </tr>
    <tr>
        <td class="bold fontSize" style="width: 170px;">Nama</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td class="fontSize"><?php echo $data[$x]['customer_name']; ?></td>
    </tr>
    <tr>
        <td class="bold fontSize" style="width: 170px;"></td>
        <td class="bold tdwidth2 fontSize"></td>
        <td class="fontSize"><?php echo $data[$x]['customer_phone'];?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold">Alamat</td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2">:</td>
        <td style="width: 300px;" class="fontSize"><?php echo $data[$x]['customer_address_1'];?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px;" class="fontSize"><?php echo $data[$x]['customer_address_2'];?></td>
    </tr> 
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px; font-weight: bold;" class="fontSize"><?php echo $data[$x]['customer_address_3'];?></td>
    </tr> 
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $data[$x]['description'];?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $data[$x]['payment_method_name'];?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $data[$x]['description_2'];?></td>
    </tr>
    <tr>
        <td colspan="3" style="height:10px;"></td>
    </tr>
    <?php if($data[$x]['voucher'] != 0){ ?>
    <tr>
        <td style="text-align: center; font-style: italic; font-weight: bold;" class="fontSize">POT/VOUCHER</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td style="font-style: italic;" class="fontSize"><?php  echo 'IDR ' . number_format($data[$x]['voucher'],0,',','.');?></td>
    </tr>
    <?php } ?>
    <tr>
        <td style="text-align: center; font-style: italic; font-weight: bold;" class="fontSize">TGL KIRIM</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td style="font-style: italic;" class="fontSize"><?php echo date('d F Y', strtotime($data[$x]['shipping_date']));;?></td>
    </tr>
</table>
</div>
<table class="margin2">
        <tr>
            <th class="test" rowspan="2" style="text-align: center; width: 150px">PESANAN</th>
            <th class="test" colspan="2" rowspan="2" style="text-align: center; width: 50px">QTY</th>
            <th class="test" style="text-align: center; width: 125px;">HARGA SUDAH</th>
            <th rowspan="2" style="width: 55px;"></th>
            <th></th>
            <!--<th>Option</th>-->
        </tr>
        <tr>
            <th class="test2" style="text-align: center">DIKALI</th>
            <!--<th>Option</th>-->
        </tr>
        <?php
        $totalPrice = 0;
        $no = 1;
        for($y=0;$y<count($data[$x]['transaction']);$y++){
        $price = $data[$x]['transaction'][$y]['item_price'];
        ?>
        <tr>
            <td class="test" style="background-color: <?php if($data[$x]['transaction'][$y]['highlight_color'] != NULL){ echo $data[$x]['transaction'][$y]['highlight_color'];} else { echo 'white';} ?>;"><?php echo $data[$x]['transaction'][$y]['item_name']; ?></td>
            <td class="test" style="background-color: <?php if($data[$x]['transaction'][$y]['highlight_color'] != NULL){ echo $data[$x]['transaction'][$y]['highlight_color'];} else { echo 'white';} ?>;"><?php echo $data[$x]['transaction'][$y]['item_qty']; ?></td>
            <td class="test" style="background-color: <?php if($data[$x]['transaction'][$y]['highlight_color'] != NULL){ echo $data[$x]['transaction'][$y]['highlight_color'];} else { echo 'white';} ?>;"><?php echo $data[$x]['transaction'][$y]['unit_name']; ?></td>
            <td class="test align" style="background-color: <?php if($data[$x]['transaction'][$y]['highlight_color'] != NULL){ echo $data[$x]['transaction'][$y]['highlight_color'];} else { echo 'white';} ?>;"><span>IDR</span> <?php
            echo number_format($price,0,',','.'); ?></td>
            <td style="font-style: italic; color: red;"><?php echo $data[$x]['transaction'][$y]['description']; ?></td>
        </tr>
        <?php
            $totalPrice += $price;
        }
        ?>
        
        <tr>
            <td colspan="3" class="test">Total</td>
            <td class="test align">IDR <?php echo number_format($totalPrice,0,',','.');?></td>
            <td></td>
        </tr>
        <?php if($data[$x]['voucher'] != 0){ 
            $totalAfterDeduction = $totalPrice - $data[$x]['voucher']; ?>
        <tr>
            <td colspan="3" class="test">Total Setelah Pot.</td>
            <td class="test align">IDR <?php echo number_format($totalAfterDeduction,0,',','.'); ?>
            </td>
        <td></td>
        </tr>
        <?php } ?> 
        </table>
    <div>
        <img src="https://s11.postimg.org/l8ajv99b7/footerfixks.jpg" width="400" height="110" style="padding-left: 15px;"/>
    </div>
    <footer></footer>
</page>
<?php } ?>
</body>
</html>