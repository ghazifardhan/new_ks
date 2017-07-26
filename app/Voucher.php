<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';

    protected $fillable = [
    	'customer_id',
    	'credit',
    	'is_used',
    	'invoice_id',
    	'description',
    	'is_debit'
    ];

    public $validate = [
    	'credit',
    	'description'
    ];

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }
}
