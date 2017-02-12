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

    public function voucher(){
    	return $this->hasMany('App\Voucher');
    }

}
