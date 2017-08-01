<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Item;
use App\Transaction;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public $transaction;
    public $time;

    public function __construct(){
    	$this->transaction = new Transaction();
    	$this->middleware('auth');

      date_default_timezone_set("Asia/Jakarta");
      $this->time = date("Y-m-d H:i:s");
    }

    public function index($id){

    }

    public function create($id){
    	$invoice = Invoice::find($id);
    	$item = Item::all();
      $form = config('app.form_generate');
    	return view('transaction.form', compact('invoice', 'item', 'form'));
    }

    public function store(Request $request, $id){
        dd($request->input());

        $invoice = Invoice::find($id);
        $array = $request->input('item_qty');
        $item_id = $request->input('item_id');
        $item_qty = $request->input('item_qty');
        $discount = $request->input('discount');
        $deduction = $request->input('deduction');
        $description = $request->input('description');

        for($x = 0 ; $x < count($array) ; $x++){

            $item = Item::find($item_id[$x]);
            //print_r($item->item_name);

            DB::table('transaction')->insert(
            [
            'invoice_id' => $invoice->id,
            'item_id' => $item_id[$x],
            'item_qty'=>$item_qty[$x],
            'discount'=>$discount[$x],
            'deduction'=>$deduction[$x],
            'description'=>$description[$x],
            'item_price' => ($item->real_price*$item_qty[$x]*((100-$discount[$x])/100))-$deduction[$x],
            'created_at' => $this->time,
            'updated_at' => $this->time,
            ]
            );
        }
        return Redirect::route('invoice.show', compact('invoice'));
    }

    public function edit($id, $idtrans){
        $invoice = Invoice::find($id);
        $transaction = $this->transaction->find($idtrans);
        $item = Item::all();

        return view('transaction.form_edit', compact('invoice', 'transaction', 'item'));
    }

    public function update(Request $request, $id, $idtrans){
        $invoice = Invoice::find($id);
        $transaction = $this->transaction->find($idtrans);
        $item = Item::find($request->input('item_id'));

        $transaction->item_id = $request->input('item_id');
        $transaction->item_qty = $request->input('item_qty');
        $transaction->discount = $request->input('discount');
        $transaction->deduction = $request->input('deduction');
        $transaction->description = $request->input('description');
        $transaction->item_price = ($item->real_price*$transaction->item_qty*((100-$transaction->discount)/100))-$transaction->deduction;
        $transaction->save();
        return Redirect::route('invoice.show', compact('invoice'));
    }

    public function batchDelete(Request $request, $id){
        $invoice = Invoice::find($id);
        $array = $request->input('delete');
        //print_r($array);
        foreach($array as $key => $val){
            DB::table('transaction')->where('id', '=', $val)->delete();
        }
        return Redirect::route('invoice.show', compact('invoice'));
    }
}
