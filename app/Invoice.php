<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = [
    	'invoice_code', 
    	'invoice_date', 
    	'customer_name', 
    	'customer_phone', 
    	'customer_address_1',
    	'customer_address_2',
    	'customer_address_3',
    	'payment_method',
    	'shipping_date',
    	'voucher',
    	'description',
    	'description_2',
    	'is_paid'
    ];

    protected $validate = [
    	'invoice_code' => 'required', 
    	'invoice_date' => 'required', 
    	'customer_name' => 'required', 
    	'customer_phone' => 'required', 
    	'customer_address_1' => 'required',
    	'payment_method' => 'required',
    	'shipping_date' => 'required'
    ];

    public function transaction(){
    	return $this->hasMany('App\Transaction', 'invoice_id');
    }
}
