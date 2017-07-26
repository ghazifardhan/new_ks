<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceCodeGenerator extends Model
{
    protected $table = 'invoice_code';

    protected $fillable = [
    	'invoice_code_1', 'invoice_code_2', 'date'
    ];
}
