<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
    	'invoice_id',
    	'item_id',
    	'item_qty',
    	'discount',
    	'deduction',
    	'item_price',
    	'description'
    ];

    protected $validate = [
    	'invoice_id' => 'required',
    	'item_id' => 'required',
    	'item_qty' => 'required'
    ];

    public function invoice(){
    	return $this->belongsTo('App\Invoice');
    }

    public function item(){
        return $this->hasOne('App\Item', 'id', 'item_id');
    }
    
    public function highlight(){
        return $this->hasOne('App\Highlight', 'id', 'highlight_id');
    }
}
