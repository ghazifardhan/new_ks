<?php

namespace App\Transformers;

use Logaretm\Transformers\Transformer;

class InvoiceTransformer extends Transformer
{


    public function getTransformation($invoice)
    {   
        $x = 0;
        return [
            'id' => $invoice->id,
            'invoice_code' => $invoice->invoice_code,
            'customer_name' => $invoice->customer_name,
            'customer_phone' => $invoice->customer_phone,
            'customer_address_1' => $invoice->customer_address_1,
            'customer_address_2' => $invoice->customer_address_2,
            'customer_address_3' => $invoice->customer_address_3,
            'payment_method' => $invoice->payment_method,
            'payment_method_name' => $invoice->paymentMethod->name,
            'shipping_date' => $invoice->shipping_date,
            'voucher' => $invoice->voucher,
            'description' => $invoice->description,
            'description_2' => $invoice->description_2,
            'total' => $invoice->total,
            'transaction' => $invoice->transaction,
        ];
    }
}