<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class UnitController extends Controller
{
    public $unit;
    public $time;

    public function __construct(){
    	$this->unit = new Unit();
        $this->middleware('auth');

        date_default_timezone_set("Asia/Jakarta");
        $this->time = date("Y-m-d H:i:s");
    }

    protected $rules = [
    	'unit_name' => 'required'
    ];



    public function index(Request $request){
    	$query = $request->get('query');
    	if($query!=null){
    		$condition=true;
    	} else {
    		$condition=false;
    	}

    	if($condition){
    		$unit = $this->unit
    						->where('unit_name', 'like', '%'.$query.'%')
    						->orWhere('description', 'like', '%'.$query.'%')
    						->paginate(25);
    	} else {
    		$unit = $this->unit->paginate(25);
    	}
    	return view('unit.index', compact('unit'));
    }

    public function create(){
    	return view('unit.form', compact('unit'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->rules);
    	//$valid = $this->_validate($request->input());
    	$this->unit->fill([
    				'unit_name' => $request->input('unit_name'),
    				'description' => $request->input('description'),
    			]);
    	$this->unit->save();
    	return Redirect::route('unit.index');
    }

    public function edit($id){
    	$unit = $this->unit->find($id);
    	return view('unit.form_edit', compact('unit'));
    }

    public function update($id, Request $request){
    	$this->validate($request, $this->rules);
    	//$unit = $this->unit->find($id);
    	$unit = $this->unit->find($id);
    	$unit->unit_name = Input::get('unit_name');
    	$unit->description = Input::get('description');
    	$unit->save();
    	return Redirect::route('unit.index');
    }

    public function destroy($id){
    	$unit = $this->unit->find($id);
    	$unit->delete();
    	return Redirect::route('unit.index');
    }
}
