<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $table = 'customer_type';

    public function customer(){
    	return $this->hasMany('App\Customer');
    }
}
