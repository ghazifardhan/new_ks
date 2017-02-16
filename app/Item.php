<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $fillable = ['item_name', 'category_id', 'unit_id', 'price', 'onqty', 'description', 'real_price', 'highlight_id', 'purchase_price', 'real_purchase_price'];

    protected $validate = [
    	'item_name' => 'required',
    	'category_id' => 'required',
    	'unit_id' => 'required',
    	'price' => 'required',
    	'onqty' => 'required',
    	'real_price' => 'required',
        'purchase_price' => 'requried',
        'real_purchase_price' => 'required',
    ];

    // Define Relationship with other table
    public function category(){
    	return $this->hasOne('App\Category','id','category_id');
    }

    public function unit(){
    	return $this->hasOne('App\Unit','id','unit_id');
    }

    public function highlight(){
    	return $this->hasOne('App\Highlight','id','highlight_id');
    }

    public function validate(){
    	return $this->validate;
    }
}
