<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['category_name', 'description'];

    protected $validate = [
    	'category_name' => 'required',
    	'description' => 'required'
    ];

    // Define relationship with other table

    public function item(){
    	return $this->hasMany('App\Item', 'category_id');
    }

    public function validate(){
    	return $this->validate();
    }
}
