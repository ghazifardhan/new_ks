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

    public function index(){
    	
    }
}
