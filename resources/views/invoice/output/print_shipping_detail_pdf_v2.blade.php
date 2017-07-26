<!DOCTYPE html>
<html>
<head>
<title>Shipping Invoice</title>
</head>
<style>
  .alignCenter {
    text-align: center;
  }

  table {
    font-size: 10px;
    border-color: green;
    border-collapse: collapse;
  }

  @media print
  {
   #not-print { display: none; }
  }

  .test2 {
      border: 1px solid #000000;
      text-align: left;
      padding: 8px;
      background-color: #ffdd00;
  }
  .test3 {
      border: 1px solid #000000;
      text-align: left;
      padding: 8px;
      background-color: #ffaa00;
  }
  .t-center {
      text-align: center;
  }
  .resultPadding {
    padding-left: 10px;
    padding-right: 10px;
  }
</style>
<body>
  <?php
  $invDateFormat = date('l, d F Y', strtotime($data[0]['invoice_date']));
  $shipDateFormat = date('l, d F Y', strtotime($data[0]['shipping_date']));
  ?>
  <div id="not-print">
      <input type="button" onclick="javascript:window.print();" value="Print">
  </div>
  <h1>SHIPPING INVOICE</h1>
  <table border="1">
      <tr>
          <td class="test2 t-center">ORDER</td>
          <td class="test2 t-center"><?php echo $invDateFormat; ?></td>
      </tr>
      <tr>
          <td class="test3 t-center">SHIPPING</td>
          <td class="test3 t-center"><?php echo $shipDateFormat; ?></td>
      </tr>
  </table>
  <br/>
  <table border="1">
    <tr>
      <th rowspan="2">INVOICE</th>
      <th rowspan="2">NAME</th>
      <th rowspan="2">ALAMAT</th>
      <th>ORDERNYA</th>
      <th colspan="2"  rowspan="2">BANYAKYA</th>
      <th>HARGA SUDAH</th>
    </tr>
    <tr>
      <th>NYA</th>
      <th>DIKALI</th>
    </tr>
    <?php foreach($data as $key => $val){
        $totalDataEachTransaction = count($data[$key]['transaction']);
        if($data[$key]['voucher'] != 0){
          $temp3 = 8;
          $rowSpan = $totalDataEachTransaction + $temp3;
        } else {
          $temp3 = 7;
          $rowSpan = $totalDataEachTransaction + $temp3;
        }
      ?>
    <tr>
      <td rowspan="<?php echo $rowSpan; ?>" style="vertical-align: top;">{{ $data[$key]['invoice_code'] }}</td>
      <td rowspan="<?php echo $rowSpan; ?>" style="vertical-align: top;">
        <?php
          echo $data[$key]['customer_name'] . "<br/>";
          echo $data[$key]['customer_phone']; ?></td>
          <td rowspan="<?php echo $rowSpan; ?>" style="vertical-align: top;">
            <?php
              echo $data[$key]['customer_address_1'] . "<br/>";
              echo $data[$key]['customer_address_2'] . "<br/>";
              echo "<b>" . $data[$key]['customer_address_3'] . "</b><br/>";
              echo "<div style='color: red;text-align:center;'>" . $data[$key]['description'] . "</div><br/>";
              echo "<div style='color: red;text-align:center;'>" . $data[$key]['description_2'] . "</div><br/>";
              echo "<div style='color: red;text-align:center;'>" . $data[$key]['payment_method_name'] . "</div><br/>";
              echo "<br/>";
              if($data[$key]['voucher'] != 0){
                echo "POT/VOUCHER<br/>";
                echo "IDR " . number_format($data[$key]['voucher'],0,',','.') . "<br/>";
                echo "<br/>";
              }
              ?></td>
    </tr>
    <?php foreach($data[$key]['transaction'] as $k => $v) {?>
    <tr>
      <td class="alignCenter" style="background-color: <?php echo $data[$key]['transaction'][$k]['highlight_color']; ?>">{{ $data[$key]['transaction'][$k]['item_name'] }}</td>
      <td class="alignCenter"  style="background-color: <?php echo $data[$key]['transaction'][$k]['highlight_color']; ?>">{{ $data[$key]['transaction'][$k]['item_qty'] }}</td>
      <td class="alignCenter"  style="background-color: <?php echo $data[$key]['transaction'][$k]['highlight_color']; ?>">{{ $data[$key]['transaction'][$k]['unit_name'] }}</td>
      <td style="border-right: 1px solid green;background-color: <?php echo $data[$key]['transaction'][$k]['highlight_color']; ?>" class="alignCenter" >{{ "IDR " . number_format($data[$key]['transaction'][$k]['item_price'],0,',','.') }}</td>
      <td style="border: 1px solid white"><i style="color: red;">{{ $data[$key]['transaction'][$k]['description'] }}</i></td>
    </tr>
    <?php } ?>
    <?php for($x=0;$x<5;$x++){ ?>
      <tr>
        <td style="color: white;">whitespace</td>
        <td style="color: white;">whitespace</td>
        <td style="color: white;">whitespace</td>
        <td style="color: white;">whitespace</td>
      </tr>
    <?php } ?>
    <tr>
      <td class="alignCenter"  colspan="3">TOTAL</td>
      <td class="alignCenter" >{{ "IDR " . number_format($data[$key]['total'],0,',','.') }}</td>
    </tr>
    <?php if($data[$key]['voucher'] != 0){?>
      <tr>
        <td class="alignCenter"  colspan="3">TOTAL SETELAH POT.</td>
        <td class="alignCenter" >{{ "IDR " . number_format($data[$key]['total'] - $data[$key]['voucher'],0,',','.') }}</td>
      </tr>
    <?php }} ?>
  </table>
  <br>
  <table border="1">
    <tr>
      <td class="resultPadding">TOTAL INVOICE</td>
      <td class="resultPadding"><center><?php echo count($data); ?></center></td>
    </tr>
    <tr>
      <td class="resultPadding">TOTAL CASH</td>
      <td class="resultPadding"><?php echo "IDR " . number_format($totaltest[0]['total'],0,',','.'); ?></td>
    </tr>
    <!--
    <tr>
      <td class="resultPadding">TOTAL TRANSFER</td>
      <td class="resultPadding"><?php echo "IDR " . number_format($totaltest[1]['total'],0,',','.'); ?></td>
    </tr>
    <tr>
      <td class="resultPadding">GRAND TOTAL</td>
      <td class="resultPadding"><?php echo "IDR " . number_format($totaltest[0]['total'] + $totaltest[1]['total'],0,',','.'); ?></td>
    </tr>
  -->
</body>
</html>