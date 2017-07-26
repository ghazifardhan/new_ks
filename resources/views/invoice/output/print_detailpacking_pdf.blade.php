<?php
$invDateFormat = date('l, d F Y', strtotime($data[0]['invoice_date']));
$shipDateFormat = date('l, d F Y', strtotime($data[0]['shipping_date']));
//if($num>0){
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        font-size: 10px;
    }

    .test {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
    }
	.test2 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
        background-color: #ffdd00;
    }
	.test3 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
		background-color: #ffaa00;
    }
	.test4 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
		vertical-align: middle;
    }
	.test5 {
        border: 2px solid #000000;
        text-align: right;
        padding: 8px;
    }
    .tdwidth {
        width: 100px;
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
        margin-left: 25px;
    }
    #margin2 {
        margin-left: 25px;
    }
	font {
		color: red;
		font-size: 14px;
	}
	.bordertop {
		border-top: 0px;
	}
	.t-align {
		text-align: center;
	}
    @media print
    {
     #not-print { display: none; }
    }
</style>
</head>
<body>
	<div id="margin">
  <div id="not-print">
      <input type="button" onclick="javascript:window.print();" value="Print">
  </div>
  <br/>
  <h1>DETAIL PACKING</h1>
	<table>
		<tr>
			<td class="test2 t-align">ORDER</td>
			<td class="test2 t-align"><?php echo $invDateFormat; ?></td>
		</tr>
		<tr>
			<td class="test3 t-align">SHIPPING</td>
			<td class="test3 t-align"><?php echo $shipDateFormat; ?></td>
		</tr>
	</table>
	<br/>
    <table border="1">
		<tr>
			<th class="test4 t-align" rowspan="2" style="width: 125px;">TOTAL QTY</th>
			<th class="test4 t-align" style="width: 125px;">ORDER</th>
			<th class="test4 t-align" rowspan="2">INVOICE</th>
			<th class="test4 t-align" rowspan="2" style="width: 200px;">NAMA</th>
			<th class="test4 t-align" colspan="2" rowspan="2">BANYAKNYA</th>
			<th class="test4 t-align" rowspan="2">KETERANGAN</th>
		</tr>
		<tr>
			<th class="test4 t-align">NYA</th>
		</tr>
        <?php
            $prevName = "";
           	foreach($data as $key => $val){
            $test = array_count_values(array_column($data, "item_id"));
            $z = $data[$key]['item_id'];
        ?>
        <tr>
          <?php
            $currentName = $data[$key]['item_name'];

            if($currentName != $prevName){
          ?>
          <td class="test4 t-align" rowspan="<?php echo $test[$z]; ?>"><font align="center" color="red">{{ $sum[$z]['item_qty'] . " " . $sum[$z]['unit_name'] }}</font></td>
          <td class="test4 t-align" rowspan="<?php echo $test[$z]; ?>" style="background-color: <?php echo $data[$key]['highlight_color']; ?>"><center>{{ $data[$key]['item_name'] }}</center></td>
          <?php
            $prevName = $currentName;
          } else {
            ?>

            <?php
          }
          ?>
          <td class="test4 t-align">{{ $data[$key]['invoice_code'] }}</td>
          <td class="test4 t-align">{{ $data[$key]['customer_name'] }}</td>
          <td class="test4 t-align" style="background-color: <?php echo $data[$key]['highlight_color']; ?>"><center>{{ $data[$key]['item_qty'] }}</center></td>
          <td class="test4 t-align" style="background-color: <?php echo $data[$key]['highlight_color']; ?>"><center>{{ $data[$key]['unit_name'] }}</center></td>
          <td class="test4 t-align">{{ $data[$key]['description'] }}</td>
        </tr>
        <?php
			   }
		?>
		</table>
	</div>
    </body>
</html>
