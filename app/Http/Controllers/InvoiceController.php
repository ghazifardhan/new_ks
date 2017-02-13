<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\PaymentMethod;
use App\Customer;
use App\Voucher;
use App\InvoiceCodeGenerator;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class InvoiceController extends Controller
{
    public $invoice;

    public function __construct(){
    	$this->invoice = new Invoice();
        $this->middleware('auth');
    }

    public function index(Request $request){
    	$query = $request->get('query');
    	if($query!=null){
    		$condition=true;
    	} else {
    		$condition=false;
    	}

    	if($condition){
    		$invoice = $this->invoice
    						->where('invoice_code', 'like', '%'.$query.'%')
    						->orWhere('customer_name', 'like', '%'.$query.'%')
    						->paginate(25);
    	} else {
    		$invoice = $this->invoice->paginate(25);	
    	}
    	return view('invoice.index', compact('invoice'));
    }

    public function create(){
    	//$customer = Customer::all();
    	$paymentMethod = PaymentMethod::all();
    	//$voucher = Voucher::all();
    	$invoiceCode = InvoiceCodeGenerator::latest()->first();
    	$invoiceTransform = $invoiceCode->sku . "/" . $invoiceCode->invoice_code_1 . "/" . $invoiceCode->invoice_code_2;

    	return view('invoice.form', compact('customer', 'paymentMethod', 'voucher', 'invoiceTransform'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->invoice->validate);
    	//$valid = $this->_validate($request->input());
    	$this->invoice->fill([
    				'invoice_code' => $request->input('invoice_code'), 
			    	'invoice_date' => $request->input('invoice_date'), 
			    	'customer_name' => $request->input('customer_name'), 
			    	'customer_phone' => $request->input('customer_phone'), 
			    	'customer_address_1' => $request->input('customer_address_1'),
			    	'customer_address_2' => $request->input('customer_address_2'),
			    	'customer_address_3' => $request->input('customer_address_3'),
			    	'payment_method' => $request->input('payment_method'),
			    	'shipping_date' => $request->input('shipping_date'),
			    	'voucher' => $request->input('voucher'),
			    	'description' => $request->input('description'),
			    	'description_2' => $request->input('description_2'),
                    'total' => '0',
			    	'is_paid' => '0',
    			]);
    	$this->invoice->save();
        $invoiceId = $this->invoice->id;
        $invoice = $this->invoice->find($invoiceId);
        return Redirect::route('invoice.show', compact('invoice'));
    	//return view('invoice.show', compact('invoice'));
    }

    public function show($id){
        $invoice = $this->invoice->find($id);
        return view('invoice.show', compact('invoice'));
    }

    public function destroy($id){
        $invoice = $this->invoice->find($id);
        $invoice->delete();
        return Redirect::route('invoice.index');
    }
}
