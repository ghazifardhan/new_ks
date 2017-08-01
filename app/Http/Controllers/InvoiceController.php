<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\PaymentMethod;
use App\Customer;
use App\Voucher;
use App\InvoiceCodeGenerator;
use App\Transaction;
use App\Item;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;
use PDF;
use App\Transformers\InvoiceTransformer;
use App\Transformers\InvoiceShowTransformer;
use App\Transformers\TransactionTransformer;
use App\Transformers\DailyOmzetTransformer;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet_Drawing;
use Illuminate\Support\Facades\DB;

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
                            ->orderBy('id', 'desc')
    						->paginate(25);
    	} else {
    		$invoice = $this->invoice->orderBy('id', 'desc')->paginate(25);
    	}
    	return view('invoice.index', compact('invoice'));
        //$pdf = PDF::loadView('invoice.index', compact('invoice'));
        //return $pdf->download('invoice.pdf');
    }

    public function create(){

    	$paymentMethod = PaymentMethod::all();


        $invoiceCode = InvoiceCodeGenerator::latest()->first();
        if($invoiceCode->date != date("Y-m-d")){
            $invoiceCode1 = $invoiceCode->invoice_code_1 + 1;
        } else {
            $invoiceCode1 = $invoiceCode->invoice_code_1;
        }
        $invoiceCode2 = $invoiceCode->invoice_code_2 + 1;

    	$invoiceTransform = $invoiceCode->sku . "/" . $invoiceCode1 . "/" . $invoiceCode2;

    	return view('invoice.form', compact('customer', 'paymentMethod', 'invoiceTransform'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->invoice->validate);
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

        //Update Invoice Code
        $invoiceCode = InvoiceCodeGenerator::find(1);
        if($invoiceCode->date != date("Y-m-d")){
            $invoiceCode1 = $invoiceCode->invoice_code_1 + 1;
        } else {
            $invoiceCode1 = $invoiceCode->invoice_code_1;
        }
        $invoiceCode2 = $invoiceCode->invoice_code_2 + 1;
        $invoiceCode->invoice_code_1 = $invoiceCode1;
        $invoiceCode->invoice_code_2 = $invoiceCode2;
        $invoiceCode->date = date("Y-m-d");
        $invoiceCode->save();

        if($request->input('customer_id') != null){
            $voucher = new Voucher();
            $customer = $request->input('customer_id');
            $voucher->fill([
                    'customer_id' => $customer,
                    'invoice_id' => $invoiceId,
                    'credit' => $request->input('voucher'),
                    'is_used' => 1,
                    'is_debit' => 1,
                    'description' => "",
                ]);
            $voucher->save();
        }

        return Redirect::route('invoice.show', compact('invoice'));
    }

    public function edit($id){
        $invoice = $this->invoice->find($id);
        $paymentMethod = PaymentMethod::all();
        return view('invoice.form_edit', compact('invoice', 'paymentMethod'));
    }

    public function update(Request $request, $id){
        $this->validate($request, $this->invoice->validate);
        $invoice = $this->invoice->find($id);
        $invoice->customer_name = $request->input('customer_name');
        $invoice->invoice_date = $request->input('invoice_date');
        $invoice->customer_phone = $request->input('customer_phone');
        $invoice->customer_address_1 = $request->input('customer_address_1');
        $invoice->customer_address_2 = $request->input('customer_address_2');
        $invoice->customer_address_3 = $request->input('customer_address_3');
        $invoice->payment_method = $request->input('payment_method');
        $invoice->shipping_date = $request->input('shipping_date');
        $invoice->voucher = $request->input('voucher');
        $invoice->description = $request->input('description');
        $invoice->description_2 = $request->input('description_2');
        $invoice->save();
        return Redirect::route('invoice.show', compact('invoice'));
    }

    public function show($id){
        $transformer = new InvoiceShowTransformer();
        $invoice = $this->invoice->with('PaymentMethod')->find($id);
        $transaction = Transaction::join('item', 'transaction.item_id', '=', 'item.id')
                            ->join('unit', 'item.unit_id','=','unit.id')
                            ->join('highlight', 'item.highlight_id','=','highlight.id')
                            ->select('transaction.id', 'transaction.invoice_id', 'transaction.item_id', 'item.item_name', 'transaction.item_qty', 'unit.unit_name', 'transaction.item_price', 'transaction.discount', 'transaction.deduction','item.real_price','transaction.description', 'transaction.created_at', 'highlight.highlight_color')
                            ->where('transaction.invoice_id','=',$id)
                            ->orderBy('item.item_name','asc')
                            ->get();
        $data = $transformer->transform($invoice);
        //$res['result'] = $invoice;
        //return response($invoice);
        return view('invoice.show', compact('invoice', 'transaction'));
    }

    public function destroy($id){
        $invoice = $this->invoice->find($id);
        $invoice->delete();
        return Redirect::route('invoice.index');
    }

    public function formPrintInvoiceByDate(){
        return view('invoice.form_print_invoice_by_date');
    }

    public function formPrintDailyOmzet(){
        return view('invoice.form_daily_omzet');
    }

    public function formPrintShippingDetail(){
        return view('invoice.form_shipping_detail');
    }

    public function formPrintDetailPacking(){
        return view('invoice.form_detail_packing');
    }

    public function printInvoice(Request $request){
      $transformer = new InvoiceTransformer();
      $id = $request->input('invoice_id');
      $invoice = $this->invoice->with(['transactionView' => function($q){
        $q->orderBy('item_name', 'asc');
      }])
      ->where('id', $id)->first();
      $data = $transformer->transform($invoice);
      //return response($data);
      return view('invoice.output.print_invoice_pdf', compact('data'));
    }

    public function printInvoiceByDate(Request $request){
        $output = $request->get('output');
        if($output == "pdf"){
                $transformer = new InvoiceTransformer();
                $invoiceDate1 = $request->get('date1');
                $invoiceDate2 = $request->get('date2');
                //$invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->whereBetween('invoice_date', [$invoiceDate1, $invoiceDate2])->get();
                $invoice = $this->invoice->with(['transactionView' => function($q){
                    $q->orderBy('item_name','asc');
                }])
                ->whereBetween('invoice_date', [$invoiceDate1, $invoiceDate2])->get();
                $data = $transformer->transform($invoice);
                //return response($data);
                return view('invoice.output.print_invoice_by_date_pdf', compact('data'));
                //$pdf = PDF::loadView('invoice.output.print_invoice_by_date_pdf', compact('data'));
                //$pdf->setPaper('a4');
                //return $pdf->stream();
            } else {

                $objPHPExcel = new PHPExcel();
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $transformer = new InvoiceTransformer();
                $invoiceDate1 = $request->get('date1');
                $invoiceDate2 = $request->get('date2');
                $invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->whereBetween('invoice_date', [$invoiceDate1, $invoiceDate2])->get();
                $data = $transformer->transform($invoice);
                abort(404);
                //return view('invoice.output.print_invoice_by_date', compact('data', 'objPHPExcel','objDrawing'));

                }
    }

    public function printDailyOmzet(Request $request){
        $output = $request->get('output');
        if($output == "pdf"){
                $transformer = new InvoiceTransformer();
                $fromDate = $request->get('fromDate');
                $invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->where('invoice_date', $fromDate)->get();
                $data = $transformer->transform($invoice);
                //$totaltest = $this->invoice->select(DB::raw('payment_method, sum(total) as total'))->where('invoice_date', $fromDate)->groupBy('payment_method')->get();

                $cash = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>1])->sum('total');
                $transfer = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>2])->sum('total');
                $cc = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>3])->sum('total');
                $totaltest['cash'] = $cash;
                $totaltest['bank_transfer'] = $transfer;
                $totaltest['credit_card'] = $cc;

                //$pdf = PDF::loadView('invoice.output.print_daily_omzet_pdf', compact('data'));
                //return $pdf->stream('daily_omzet.pdf');
                //return response($data[0]['invoice_date']);
                return view('invoice.output.print_daily_omzet_pdf', compact('data', 'totaltest'));
                //abort(404);
            } else {

                $objPHPExcel = new PHPExcel();
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $transformer = new DailyOmzetTransformer();
                $fromDate = $request->get('fromDate');
                $invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->where('invoice_date', $fromDate)->get();
                $data = $transformer->transform($invoice);

                //$totaltest = $this->invoice->select(DB::raw('payment_method, sum(total) as total'))->where('invoice_date', $fromDate)->groupBy('payment_method')->get();

                $cash = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>1])->sum('total');
                $transfer = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>2])->sum('total');
                $cc = $this->invoice->where(['invoice_date'=>$fromDate, 'payment_method'=>3])->sum('total');
                $totaltest['cash'] = $cash;
                $totaltest['bank_transfer'] = $transfer;
                $totaltest['credit_card'] = $cc;

                //return response(compact('data', 'objPHPExcel','objDrawing','totaltest'));
                return view('invoice.output.print_daily_omzet_xls', compact('data', 'objPHPExcel','objDrawing','totaltest'));

                }
    }

    public function printShippingDetail(Request $request){
        $output = $request->get('output');
        if($output == "pdf"){
                $transformer = new InvoiceTransformer();
                $fromDate = $request->get('fromDate');
                $invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->where('invoice_date', $fromDate)->get();
                $data = $transformer->transform($invoice);
                $totaltest = $this->invoice->select(DB::raw('payment_method, sum(total) as total'))->where('invoice_date', $fromDate)->groupBy('payment_method')->get();
                //return response($data);
                return view('invoice.output.print_shipping_detail_pdf_v2', compact('data', 'totaltest'));
                //abort(404);
            } else {

                $objPHPExcel = new PHPExcel();
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $transformer = new DailyOmzetTransformer();
                $fromDate = $request->get('fromDate');
                $invoice = $this->invoice->with('transaction.item.highlight','transaction.item.unit')->where('invoice_date', $fromDate)->get();
                $data = $transformer->transform($invoice);
                $totaltest = $this->invoice->select(DB::raw('payment_method, sum(total) as total'))->where('invoice_date', $fromDate)->groupBy('payment_method')->get();
                return view('invoice.output.print_shipping_detail_xls_v2', compact('data', 'objPHPExcel','objDrawing','totaltest'));

                }
    }

    public function printDetailPacking(Request $request){
        $output = $request->get('output');
        $is_highlight = $request->get('is_highlight');
        if($output == "pdf"){
                $transformer = new TransactionTransformer();
                //$transaction = Transaction::with('item.unit', 'invoice')->get();
                $GLOBALS['trigger'] = $request->get('fromDate');
                if($is_highlight == 'true'){
                  $transaction = Transaction::join('item','transaction.item_id','=','item.id')
                      ->join('invoice','transaction.invoice_id','=','invoice.id')
                      ->join('unit','item.unit_id','=','unit.id')
                      ->join('highlight','item.highlight_id','=','highlight.id')
                      ->select('transaction.id','item.id as item_id','item.item_name','invoice.invoice_date','invoice.invoice_code','invoice.shipping_date','invoice.customer_name','transaction.item_qty','unit.unit_name','transaction.description','highlight.highlight_color')
                      ->where('invoice.invoice_date',$GLOBALS['trigger'])
                      ->where('highlight.highlight_color', '<>', '#FFFFFF')
                      ->orderBy('item.item_name','asc')
                      ->get();
                } else {
                  $transaction = Transaction::join('item','transaction.item_id','=','item.id')
                      ->join('invoice','transaction.invoice_id','=','invoice.id')
                      ->join('unit','item.unit_id','=','unit.id')
                      ->join('highlight','item.highlight_id','=','highlight.id')
                      ->select('transaction.id','item.id as item_id','item.item_name','invoice.invoice_date','invoice.invoice_code','invoice.shipping_date','invoice.customer_name','transaction.item_qty','unit.unit_name','transaction.description','highlight.highlight_color')
                      ->where('invoice.invoice_date',$GLOBALS['trigger'])
                      ->orderBy('item.item_name','asc')
                      ->get();
                }

                $data = $transformer->transform($transaction);

                $sum = array_reduce($data, function ($a, $b) {
                    isset($a[$b['item_id']]) ? $a[$b['item_id']]['item_qty'] += $b['item_qty'] : $a[$b['item_id']] = $b;
                    return $a;
                });

                //return response($transaction);
                return view('invoice.output.print_detailpacking_pdf', compact('data', 'sum'));
                //abort(404);
            } else {

                $objPHPExcel = new PHPExcel();
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $transformer = new TransactionTransformer();
                $GLOBALS['trigger'] = $request->get('fromDate');
                //$transaction = Transaction::with(array('item.unit', 'item.highlight','invoice' => function($query){
                //    $query->where('invoice_date', $GLOBALS['trigger']);
                //}))->get();
                $transaction = Transaction::join('item','transaction.item_id','=','item.id')
                    ->join('invoice','transaction.invoice_id','=','invoice.id')
                    ->join('unit','item.unit_id','=','unit.id')
                    ->join('highlight','item.highlight_id','=','highlight.id')
                    ->select('transaction.id','item.id as item_id','item.item_name','invoice.invoice_date','invoice.invoice_code','invoice.shipping_date','invoice.customer_name','transaction.item_qty','unit.unit_name','transaction.description','highlight.highlight_color')
                    ->where('invoice.invoice_date',$GLOBALS['trigger'])
                    ->orderBy('item.item_name','asc')
                    ->get();
                $data = $transformer->transform($transaction);
                $sum = array_reduce($data, function ($a, $b) {
                    isset($a[$b['item_id']]) ? $a[$b['item_id']]['item_qty'] += $b['item_qty'] : $a[$b['item_id']] = $b;
                    return $a;
                });
                //return response($data);
                return view('invoice.output.print_detailpacking_xls', compact('data', 'objPHPExcel','objDrawing', 'sum'));

                }
    }
}
