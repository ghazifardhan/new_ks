<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Unit;
use App\Highlight;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{
    public $item;

    protected $rules = [
    	'item_name' => 'required'
    ];

    public function __construct(){
    	$this->item = new Item();
        $this->middleware('auth');
    }

    public function itemJson(){
        $item = $this->item->all();
        return response($item);
    }

    public function unitJson(Request $request){
        $id = $request->get('item_id');
        $item = $this->item
                    ->join('unit', 'item.unit_id','=','unit_id')
                    ->select('item.id', 'item.item_name','unit.unit_name')
                    ->where('item.id','=',$id)
                    ->get();
        return response($item);
    }

    public function index(Request $request){
    	$query = $request->get('query');
    	if($query!=null){
    		$condition=true;
    	} else {
    		$condition=false;
    	}
    	if($condition){
    		$item = $this->item
    	 			->join('category', 'item.category_id', '=', 'category.id')
    				->join('unit', 'item.unit_id', '=', 'unit.id')
    				->join('highlight', 'item.highlight_id', '=', 'highlight.id')
    				->select('item.id', 'item.item_name', 'category.category_name', 'unit.unit_name', 'item.price', 'item.onqty', 'item.description', 'highlight.highlight_name')
    				->where('item.item_name', 'like', '%'.$query.'%')
    				->orWhere('category.category_name', 'like', '%'.$query.'%')
    				->orWhere('unit.unit_name', 'like', '%'.$query.'%')
    				->orWhere('item.price', 'like', '%'.$query.'%')
    				->orWhere('item.onqty', 'like', '%'.$query.'%')
    				->orWhere('item.description', 'like', '%'.$query.'%')
    				->orWhere('highlight.highlight_name', 'like', '%'.$query.'%')
    				->paginate(25);
    	} else {
    		$item = $this->item
    	 			->join('category', 'item.category_id', '=', 'category.id')
    				->join('unit', 'item.unit_id', '=', 'unit.id')
    				->join('highlight', 'item.highlight_id', '=', 'highlight.id')
    				->select('item.id', 'item.item_name', 'category.category_name', 'unit.unit_name', 'item.price', 'item.onqty', 'item.description', 'highlight.highlight_name')
    				->paginate(25);	
    	}
    	
    	//$res['result'] = $item;
    	//return response($res);
    	return view('item.index', compact('item'));
    }

    public function create(){
    	$category = Category::all();
    	$unit = Unit::all();
    	$highlight = Highlight::all();
    	//$mArray = array($category, $unit, $highlight);
    	return view('item.form', compact('category', 'unit', 'highlight'));
    }

    public function store(Request $request){
    	$this->validate($request, $this->rules);
    	//$valid = $this->_validate($request->input());
    	$this->item->fill([
    				'item_name' => $request->input('item_name'),
    				'category_id' => $request->input('category_id'),
    				'unit_id' => $request->input('unit_id'),
    				'onqty' => $request->input('onqty'),
    				'price' => $request->input('price'),
    				'highlight_id' => $request->input('highlight_id'),
    				'description' => $request->input('description'),
    				'real_price' => $request->input('price') / $request->input('onqty'),
    			]);
    	$this->item->save();
    	return Redirect::route('item.index');
    	
    }

    public function edit($id){
    	$item = $this->item->find($id);
    	$category = Category::all();
    	$unit = Unit::all();
    	$highlight = Highlight::all();
    	return view('item.form_edit', compact('item', 'category', 'unit', 'highlight'));
    }

    public function update($id, Request $request){
    	$this->validate($request, $this->rules);
    	$item = $this->item->find($id);
    	$item->item_name = Input::get('item_name');
    	$item->category_id = Input::get('category_id');
    	$item->unit_id = Input::get('unit_id');
    	$item->onqty = Input::get('onqty');
    	$item->price = Input::get('price');
    	$item->highlight_id = Input::get('highlight_id');
    	$item->description = Input::get('description');
    	$item->real_price = $item->price / $item->onqty;
    	$item->save();
    	return Redirect::route('item.index');
    }

    public function destroy($id){
    	$item = $this->item->find($id);
    	$item->delete();
    	return Redirect::route('item.index');
    }
}
