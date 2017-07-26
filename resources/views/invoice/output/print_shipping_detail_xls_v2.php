<?php
// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');

// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("KERANJANG SAYUR")
                             ->setLastModifiedBy("KERANJANG SAYUR")
                             ->setTitle("DAILY OMZET")
                             ->setSubject("DAILY OMZET")
                             ->setDescription("DAILY OMZET OF KERANJANG SAYUR")
                             ->setKeywords("DAILY OMZET")
                             ->setCategory("DAILY OMZET");

$font = array(
    'font' => array(
        'name' => 'Calibri')
);

$styleArray = array(
    'font' => array(
        'bold' => true,
        'italic' => true,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$border = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$borderTop = array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$borderOutline = array(
        'borders' => array(
            'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            ),
            'vertical' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$bold = array(
    'font' => array(
        'bold' => true)
);
    
$color = array( 
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$forDesc = array( 
    'font' => array(
        'italic' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$fillOrder = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFDD00')
                )
);
$fillShip = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFAA00')
                )
);



//$invoice->invoiceDate = $_GET['fromDate'];
//$stmt2 = $invoice->getShipping();
//$row2 = $stmt2->fetch(PDO::FETCH_OBJ);
//$stmt3 = $invoice->getTotalInvoice();
//$num3 = $stmt3->rowCount();
$invDate = $data[0]['invoice_date'];
$invDateFormat = date('l, d F Y', strtotime($data[0]['invoice_date']));
//$shipDate = $row2->shipping;
$shipDateFormat = date('l, d F Y', strtotime($data[0]['shipping_date']));



$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setHeader(0.8);
$objPHPExcel->getActiveSheet()->getPageMargins()->setFooter(0.8);

$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$objPHPExcel->getActiveSheet()->getStyle('A1:E100')->applyFromArray($font);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
// Header
    
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($fillOrder);
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($fillShip);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($border);

// Add some data

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ORDER')
            ->setCellValue('B1', $invDateFormat)
            ->setCellValue('A2', 'SHIPPING  ')
            ->setCellValue('B2', $shipDateFormat);


// table
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A4:A5')
            ->setCellValue('A4', 'INVOICE')
            ->mergeCells('B4:B5')
            ->setCellValue('B4', 'NAME')
            ->mergeCells('C4:C5')
            ->setCellValue('C4', 'ALAMAT')
            ->setCellValue('D4', 'ORDER')
            ->setCellValue('D5', 'NYA')
            ->mergeCells('E4:F5')
            ->setCellValue('E4', 'BANYAKNYA')
            ->setCellValue('G4', 'HARGA SUDAH')
            ->setCellValue('G5', 'DIKALI');
$row = 6;
//$stmtInvoice = $invoice->detailPacking();
for($x=0;$x<count($data);$x++){
//$transaction->transactionCode = $rowInvoice->invoice_code;
//$stmtTrans = $transaction->index();
$totalRowEachInv = count($data[$x]['transaction']);

$phone = $row+1;
$address2 = $row+1;
$address3 = $row+2;
$desc = $row+3;
$pmn = $row+4;
$desc2 = $row+5;
$strVoucher = $row+7;
$voucher = $row+8;

if($data[$x]['voucher'] != 0){
    $num = 8;
    $temp = 1;
} else {
    $num = 7;
    $temp = 0;
}

if($totalRowEachInv < 9){
        $rows = $row + $num + $temp;
    } else { $rows = $row + $totalRowEachInv + $temp; }

$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':C'.$rows)->applyFromArray($borderOutline);    
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->applyFromArray($color);
$objPHPExcel->getActiveSheet()->getStyle('C'.$address3)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $data[$x]['invoice_code'])
                ->setCellValue('B'.$row, strtoupper($data[$x]['customer_name']))
                ->setCellValue('B'.$phone, $data[$x]['customer_phone'])
                ->setCellValue('C'.$row, $data[$x]['customer_address_1'])
                ->setCellValue('C'.$address2, $data[$x]['customer_address_2'])
                ->setCellValue('C'.$address3, strtoupper($data[$x]['customer_address_3']))
                ->setCellValue('C'.$desc, strtoupper($data[$x]['description']))
                ->setCellValue('C'.$desc2, strtoupper($data[$x]['description_2']))
                ->setCellValue('C'.$pmn, strtoupper($data[$x]['payment_method_name']));

        if($data[$x]['voucher'] != 0){
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher.':C'.$voucher)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher)->applyFromArray($bold);
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C'.$strVoucher, 'POT/VOUCHER')
                        ->setCellValue('C'.$voucher, $data[$x]['voucher']);
        }

    if($totalRowEachInv < 9){
            $rows = $row + $num;
        } else { $rows = $row + $totalRowEachInv; }

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':D'.$rows)->applyFromArray($borderOutline);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row.':G'.$rows)->applyFromArray($borderOutline);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row.':F'.$rows)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    for($y=0;$y<count($data[$x]['transaction']);$y++){
        $fill = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => preg_replace('/^#/', '', $data[$x]['transaction'][$y]['item']['highlight']->highlight_color))
                    )
                );
        if($data[$x]['transaction'][$y]['item']['highlight']->highlight_color != NULL){
            $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($fill);
        }
        
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
        
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($forDesc);
        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D'.$row, strtoupper($data[$x]['transaction'][$y]['item']->item_name))
                ->setCellValue('E'.$row, $data[$x]['transaction'][$y]->item_qty)
                ->setCellValue('F'.$row, $data[$x]['transaction'][$y]['item']['unit']->unit_name)
                ->setCellValue('G'.$row, $data[$x]['transaction'][$y]['item_price'])
                ->setCellValue('H'.$row, $data[$x]['transaction'][$y]['description']);
        $row++;
    }
        
    if($totalRowEachInv < 9){
        //$num = 9 - $totalRowEachInv;
        $row = $row + $num - $totalRowEachInv;
    } else { $row = $row; }
    
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
    $totalBeforeDeduction = $data[$x]['total'] + $data[$x]['voucher']; 
    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('D'.$row.':F'.$row)
                ->setCellValue('D'.$row, 'TOTAL')
                ->setCellValue('G'.$row, $totalBeforeDeduction);

    if($data[$x]['voucher'] != 0){


    $row = $row + 1;


    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('D'.$row.':F'.$row)
                ->setCellValue('D'.$row, 'TOTAL SETELAH POT.')
                ->setCellValue('G'.$row, $data[$x]['total']); 
    }

    $row++;
    $totalInvoiceCash = 0;
    $totalInvoiceTransfer = 0;
    if($data[$x]['payment_method'] == '1'){
        $totalInvoiceCash += $data[$x]['total'];
    }
    if($data[$x]['payment_method'] == '2'){
        $totalInvoiceTransfer += $data[$x]['total'];
    }
}

$totalInvoice = $row+2;
$totalCash = $row + 3;
$totalTransfer = $row + 4;
$grandTotal = $row + 5;

$objPHPExcel->getActiveSheet()->getStyle('A'.$totalInvoice.':B'.$grandTotal)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A'.$totalInvoice.':B'.$grandTotal)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A'.$totalInvoice.':B'.$grandTotal)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B'.$totalCash.':B'.$grandTotal)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');

$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$totalInvoice, 'TOTAL INVOICE')
                ->setCellValue('B'.$totalInvoice, count($data))
                ->setCellValue('A'.$totalCash, 'TOTAL CASH')
                ->setCellValue('B'.$totalCash, $totaltest[0]['total']);

// Rename wo'2016-11-22't
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Sheet1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=shipping_detail-$invDate.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>