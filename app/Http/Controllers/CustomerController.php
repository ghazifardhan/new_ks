<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerType;
use App\Voucher;

class CustomerController extends Controller
{
    public $customer;

    public function __construct(){
    	$this->customer = new Customer();
        $this->middleware('auth');
    }

    public function autocomplete(){
    	$customer = $this->customer->all();
    	$rows = array();
    	foreach($customer as $c){
    		$rows[] = array(
    			'label' => $c->customer_name,
    			'value' => $c->customer_name,
    			'name' => $c->customer_name,
    			'id' => $c->id,
    			);
    	}

    	return response($rows);
    }

    public function populateVoucher(Request $request){
    	$id = $request->get('customer_id');
    	
    	$voucher = Voucher::where('customer_id','=',$id)->get();

    	return response($voucher);

    }
}
