<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Highlight;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class HighlightController extends Controller
{
    public $highlight;
    public $time;

    protected $rules = [
    	'highlight_name' => 'required',
    	'highlight_color' => 'required'
    ];

    public function __construct(){
    	$this->highlight = new Highlight();
        $this->middleware('auth');

        date_default_timezone_set("Asia/Jakarta");
        $this->time = date("Y-m-d H:i:s");
    }

    public function index(Request $request){
    	$query = $request->get('query');
    	if($query!=null){
    		$condition=true;
    	} else {
    		$condition=false;
    	}
    	if($condition){
    		$highlight = $this->highlight
    						->where('highlight_name', 'like', '%'.$query.'%')
    						->orWhere('highlight_color', 'like', '%'.$query.'%')
    						->orWhere('description', 'like', '%'.$query.'%')
    						->paginate(25);
    	} else {
    		$highlight = $this->highlight->paginate(25);
    	}
    	return view('highlight.index', compact('highlight'));
    }

    public function create(){
    	return view('highlight.form', compact('highlight'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->rules);
    	//$valid = $this->_validate($request->input());
    	$this->highlight->fill([
    				'highlight_name' => $request->input('highlight_name'),
    				'highlight_color' => $request->input('highlight_color'),
    				'description' => $request->input('description'),
    			]);
    	$this->highlight->save();
    	return Redirect::route('highlight.index');

    }

    public function edit($id){
    	$highlight = $this->highlight->find($id);
    	return view('highlight.form_edit', compact('highlight'));
    }

    public function update($id, Request $request){
    	$this->validate($request, $this->rules);
    	//$highlight = $this->highlight->find($id);
    	$highlight = $this->highlight->find($id);
    	$highlight->highlight_name = Input::get('highlight_name');
    	$highlight->highlight_color = Input::get('highlight_color');
    	$highlight->description = Input::get('description');
    	$highlight->save();
    	return Redirect::route('highlight.index');
    }

    public function destroy($id){
    	$highlight = $this->highlight->find($id);
    	$highlight->delete();
    	return Redirect::route('highlight.index');
    }
}
