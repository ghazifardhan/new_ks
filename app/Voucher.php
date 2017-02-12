<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }
}
