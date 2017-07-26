<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerType;
use App\Voucher;
use Redirect;
use Illuminate\Support\Facades\DB;

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
    	
    	$voucher = Voucher::select(DB::raw('customer_id, SUM(IF(is_debit = 0, credit, -credit)) as credit'))->where('customer_id','=',$id)->groupBy('customer_id')->get();

    	return response($voucher);

    }

    public function index(Request $request){
        $query = $request->get('query');
        if($query!=null){
            $condition=true;
        } else {
            $condition=false;
        }
        if($condition){
            $customer = $this->customer
                            ->where('customer_name', 'like', '%'.$query.'%')
                            ->orWhere('customer_type', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%')
                            ->paginate(25);
        } else {
            $customer = $this->customer->paginate(25);    
        }
        return view('customer.index', compact('customer'));
    }

    public function create(){
        $customer_type = CustomerType::all();
        return view('customer.form', compact('customer_type'));
    }

    public function store(Request $request){
        $this->validate($request, $this->customer->validate);
        $this->customer->fill([
                'customer_name' => $request->input('customer_name'),
                'customer_type' => $request->input('customer_type'),
                'description' => $request->input('description')
            ]);
        $this->customer->save();
        return Redirect::route('customer.index');
    }

    public function edit($id){
        $customer = $this->customer->find($id);
        $customer_type = CustomerType::all();
        return view('customer.form_edit', compact('customer', 'customer_type'));
    }

    public function update(Request $request, $id){
        $customer = $this->customer->find($id);
        $customer->customer_name = $request->input('customer_name');
        $customer->customer_type = $request->input('customer_type');
        $customer->description = $request->input('description');
        $customer->save();
        return Redirect::route('customer.index');
    }

    public function show($id){
        $customer = $this->customer->find($id);
        $voucher = Voucher::leftJoin('invoice', 'voucher.invoice_id','=','invoice.id')
                                    ->select('voucher.id', 'voucher.customer_id','voucher.credit','voucher.is_used','voucher.invoice_id','voucher.description','voucher.is_debit','invoice.invoice_code')
                                    ->where('voucher.customer_id','=',$customer->id)->get();
        return view('customer.show', compact('customer','voucher'));
    }

    public function destroy($id){
        $customer = $this->customer->find($id);
        $customer->delete();
        return Redirect::route('customer.index');
    }
}
