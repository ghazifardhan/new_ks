<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $table = 'highlight';
    protected $fillable = ['highlight_name', 'highlight_color', 'description'];

    protected $validate = [
    	'highlight_name' => 'required',
    	'description' => 'required'
    ];

    // Define relationship with other table

    public function item(){
    	return $this->hasMany('App\Item', 'highlight_id');
    }

    public function validate(){
    	return $this->validate();
    }
}
