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
        'total',
    	'is_paid'
    ];

    public $validate = [
    	'invoice_code' => 'required', 
    	'invoice_date' => 'required', 
    	'customer_name' => 'required', 
    	'customer_phone' => 'required', 
    	'customer_address_1' => 'required',
    	'payment_method' => 'required',
    	'shipping_date' => 'required'
    ];

    public function transaction(){
    	return $this->hasMany('App\Transaction', 'invoice_id', 'id');
    }

    public function highlight(){
        return $this->hasOne('App\Highlight', 'id', 'highlight_id');
    }
	
	public function item(){
		return $this->hasMany('App\Item','item_id','id');
	}

    public function paymentMethod(){
        return $this->hasOne('App\PaymentMethod', 'id', 'payment_method');
    }
	
}
