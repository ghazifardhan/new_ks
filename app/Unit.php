<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['unit_name', 'description'];

    protected $validate = [
    	'unit_name' => 'required',
    	'description' => 'required'
    ];

    // Define relationship with other table

    public function item(){
    	return $this->hasMany('App\Item', 'unit_id');
    }

    public function validate(){
    	return $this->validate();
    }
}
