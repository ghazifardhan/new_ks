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
            'item_id' => $transaction->item->id,
            'item_name' => $transaction->item->item_name,
            'invoice_code' => $transaction->invoice->invoice_code,
            'invoice_date'=> $transaction->invoice->invoice_date,
            'shipping_date'=> $transaction->invoice->shipping_date,
            'customer_name' => $transaction->invoice->customer_name,
            'item_qty' => $transaction->item_qty,
            'unit_name' => $transaction->item->unit->unit_name,
            'description' => $transaction->description,
            'highlight_color' => $transaction->item->highlight->highlight_color,
        ];
    }
}