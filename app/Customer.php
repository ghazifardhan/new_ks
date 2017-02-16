<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
    	'customer_name',
    	'customer_type',
    	'description'
    ];

    public $validate = [
    	'customer_name' => 'required',
    	'customer_type' => 'required',
    ];

    public function voucher(){
    	return $this->hasMany('App\Voucher');
    }

    public function customerType(){
    	return $this->hasOne('App\CustomerType');
    }

}
