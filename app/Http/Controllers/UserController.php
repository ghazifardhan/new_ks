<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public $user;

    public function __construct(){
    	$this->user = new User();
    	$this->middleware('auth');
    }

    public function index(){
    	$user = $this->user->paginate(25);
    	return view('user.index', compact('user'));
    }

    public function create(){
    	return view('user.form');
    }

    public function store(Request $request){
    	//$this->validate($request, $this->user->validate);
    	$this->user->fill([
    			'username' => $request->input('username'),
    			'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'password_confirmation' => bcrypt($request->input('password')),
                'level' => $request->input('level'),
    		]);
    	$this->user->save();
    	return Redirect::route('user.index');
    }
}
