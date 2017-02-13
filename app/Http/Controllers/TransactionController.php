<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Item;
use App\Transaction;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
{
    public $transaction;

    public function __construct(){
    	$this->transaction = new Transaction();
    	$this->middleware('auth');
    }

    public function index($id){
    	
    }

    public function create($id){
    	$invoice = Invoice::find($id);
    	$item = Item::all();
    	return view('transaction.form', compact('invoice', 'item'));
    }

    public function store(Request $request, $id){
    	$invoice = Invoice::find($id);

    	$array = $request->input('item_id');
    	for($x=0;$x<count($array);$x++){
    		$this->transaction->fill([
    			'invoice_id' => $invoice->id,
    			'item_id' => $request->input('item_id.'.$x),
    			'item_qty' => $request->input('item_qty.'.$x),
    			'discount' => $request->input('discount.'.$x),
    			'deduction' => $request->input('deduction.'.$x),
    			'description' => $request->input('description.'.$x),
    			'item_price' => '1000'
    		]);
    		$this->transaction->save();	
    	}
    }
}
