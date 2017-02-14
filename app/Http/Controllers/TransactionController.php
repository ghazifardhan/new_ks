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
        $array = $_POST['item_id'];
        for($x=0;$x<count($array);$x++){
            $this->transaction->fill([
                    'invoice_id' => $invoice->id,
                    'item_id' => $_POST['item_id'][$x],
                    'item_qty' => $_POST['item_qty'][$x],
                    'discount' => $_POST['discount'][$x],
                    'deduction' => $_POST['deduction'][$x],
                    'description' => $_POST['description'][$x],
                    'item_price' => $x,
                ]);
            $this->transaction->save();
        }      
    }
}
