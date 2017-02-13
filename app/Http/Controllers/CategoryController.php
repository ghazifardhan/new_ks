<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    
    public $category;

    protected $rules = [
    	'category_name' => 'required'
    ];

    public function __construct(){
    	$this->category = new Category();
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
    		$category = $this->category
    						->where('category_name', 'like', '%'.$query.'%')
    						->orWhere('description', 'like', '%'.$query.'%')
    						->paginate(25);
    	} else {
    		$category = $this->category->paginate(25);	
    	}
    	return view('category.index', compact('category'));
    }

    public function create(){
    	return view('category.form', compact('category'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->rules);
    	//$valid = $this->_validate($request->input());
    	$this->category->fill([
    				'category_name' => $request->input('category_name'),
    				'description' => $request->input('description'),
    			]);
    	$this->category->save();
    	return Redirect::route('category.index');
    	
    }

    public function edit($id){
    	$category = $this->category->find($id);
    	return view('category.form_edit', compact('category'));
    }

    public function update($id, Request $request){
    	$this->validate($request, $this->rules);
    	//$category = $this->category->find($id);
    	$category = $this->category->find($id);
    	$category->category_name = Input::get('category_name');
    	$category->description = Input::get('description');
    	$category->save();
    	return Redirect::route('category.index');
    }

    public function destroy($id){
    	$category = $this->category->find($id);
    	$category->delete();
    	return Redirect::route('category.index');
    }

}
