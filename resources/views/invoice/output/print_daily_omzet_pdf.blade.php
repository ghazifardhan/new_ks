<!DOCTYPE html>
<html>
<head>
    <title>Daily Omzet</title>
</style>
</head>
<body>
<table>
    <tr>
        <th style="height: 13px;width: 60px;" rowspan="2">INVOICE</th>
        <th rowspan="2" style="width: 100px;">NAMA</th>
        <th style="width: 200px;" rowspan="2">ALAMAT</th>
        <th style="width: 150px;">ORDER</th>
        <th colspan="2" rowspan="2">BANYAKNYA</th>
        <th style="width: 80px;">HARGA SUDAH</th>
    </tr>
    <tr>
        <th style="border-left: 0px;">NYA</th>
        <th>DIKALI</th>
    </tr>
    @php for($x=0;$x<count($data);$x++){ @endphp
    <tr>
        <td style="text-align: left; vertical-align: top;"><?php echo $data[$x]['invoice_code'];?></td>
        <td style="text-align: left; vertical-align: top;">
            <?php 
        echo $data[$x]['customer_name'] . "<br/>";
        echo $data[$x]['customer_phone'] . "<br/>";
            ?></td>
        <td style="vertical-align: top;">
            <?php 
                echo $data[$x]['customer_address_1'] . "<br/>";
                if($data[$x]['customer_address_2'] == ""){ } else { echo $data[$x]['customer_address_2'] . "<br/>"; }
                if($data[$x]['customer_address_3'] == ""){ } else { echo "<p class='boldp'>" . $data[$x]['customer_address_3'] . "</p>"; }
                echo "<p class='centerp'>" . strtoupper($data[$x]['description']) . "</p>";
                echo "<p class='centerp'>" . strtoupper($data[$x]['payment_method_name']) . "</p>";
                echo "<p class='centerp'>" . strtoupper($data[$x]['description_2']) . "</p>";
                if($data[$x]['voucher'] > 0){
                                echo "POT/VOUCHER" . "<br/>";
                                echo "<p class='boldp'>IDR " . number_format($data[$x]['voucher'],0,',','.') . "</p>";
                            } else { }
            ?>
        </td>
    </tr>
        <?php
        for($y=0;$y<count($data[$x]['transaction']);$y++){
        ?>
        <tr>
            <td><?php echo strtoupper($data[$x]['transaction'][$y]['item']->item_name);?></td>
            <td><?php echo $data[$x]['transaction'][$y]->item_qty;?></td>
            <td><?php echo $data[$x]['transaction'][$y]['item']['unit']->unit_name;?></td>
            <td><?php echo "IDR " . number_format($data[$x]['transaction'][$y]['item_price'],0,',','.');?></td>
        </tr>
     @php } }    @endphp
</table>


