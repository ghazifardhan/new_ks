<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use App\Invoice;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoice = Invoice::select(DB::raw('invoice_date, sum(total) as total, count(invoice_code) as inv'))
                    ->orderBy('invoice_date', 'desc')
                    ->groupBy('invoice_date')
                    ->paginate(25);

        return view('home', compact('invoice'));
        //return response($invoice);
    }

    public function test(){
        $object = new PHPExcel();
        return view('invoice/output/print_invoice_xls_rev', compact('object'));
    }
}
