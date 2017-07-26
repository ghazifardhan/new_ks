<?php

namespace App\Transformers;

use Logaretm\Transformers\Transformer;

class TransactionTransformer extends Transformer
{

    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($transaction)
    {
        return [
            'id' => $transaction->id,
            'item_id' => $transaction->item_id,
            'item_name' => $transaction->item_name,
            'invoice_code' => $transaction->invoice_code,
            'invoice_date'=> $transaction->invoice_date,
            'shipping_date'=> $transaction->shipping_date,
            'customer_name' => $transaction->customer_name,
            'item_qty' => $transaction->item_qty,
            'unit_name' => $transaction->unit_name,
            'description' => $transaction->description,
            'highlight_color' => $transaction->highlight_color,
        ];
    }
}