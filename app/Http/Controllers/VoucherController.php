<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Customer;
use Redirect;


class VoucherController extends Controller
{
    public $voucher;

    public function __construct(){
    	$this->voucher = new Voucher();
    }

    public function create($id){
    	$customer = Customer::find($id);
    	return view('voucher.form', compact('customer'));
    }

    public function store(Request $request, $id){
    	$customer = Customer::find($id);
    	$this->validate($request, $this->voucher->validate);
    	$this->voucher->fill([
    			'customer_id' => $customer->id,
    			'credit' => $request->input('credit'),
    			'description' => $request->input('description'),
    		]);
    	$this->voucher->save();
    	return Redirect::route('customer.show', compact('customer'));
    }

    public function edit($id, $idvoucher){
        $customer = Customer::find($id);
        $voucher = $this->voucher->find($idvoucher);
        return view('voucher.form_edit', compact('customer', 'voucher'));
    }

    public function update(Request $request, $id, $idvoucher){
        $customer = Customer::find($id);
        $voucher = $this->voucher->find($idvoucher);

        $voucher->credit = $request->input('credit');
        $voucher->description = $request->input('description');
        $voucher->save();
        return Redirect::route('customer.show', compact('customer'));
    }

    public function destroy($id, $idvoucher){
        $customer = Customer::find($id);
        $voucher = $this->voucher->find($idvoucher);
        $voucher->delete();
        return Redirect::route('customer.show', compact('customer'));

    }
}
