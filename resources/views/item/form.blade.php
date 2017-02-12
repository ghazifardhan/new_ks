@extends('layouts.app')
@section('content')
<h1>Create New Item</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model(new App\Item, ['class' => 'form-horizontal', 'route' => 'item.store']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td class='col-md-2'>Item Name</td>
                <td class='col-md-6'><input type="text" name="item_name" class='form-control'></td>
            </tr>
            <tr>
            <td class='col-md-2'>Category</td>
            <td class='col-md-6'><select data-placeholder="Choose Category" name="category_id" class="form-control chosen-select">
                    <option value=""></option>
                    @foreach($category as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>
                    </td>
            </tr>
            <tr>
                <td class='col-md-2'>Unit</td>
                <td class='col-md-6'>
                    <select data-placeholder="Choose Unit" id="unitId" name="unit_id" class='form-control chosen-select'>
                    <option value=""></option>
                    
                    @foreach($unit as $unit)
                    <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                    @endforeach
                    </select>
                    
                    </td>
            </tr>
            <tr>
                <td class="col-md-2"></td>
                <td class="col-md-6">
                    <input type="number" id="onqty" name="onqty" class='form-control' />
                </td>
            </tr>
            <tr>
                <td class='col-md-2'>Price</td>
                <td class='col-md-6'><input type="number" name="price" class='form-control'></td>
            </tr>
			<tr>
                <td class='col-md-2'>Highlight</td>
                <td class='col-md-6'><select data-placeholder="Choose Highlight" id="highlight_id" name="highlight_id" class='form-control chosen-select'>
                    <option value=""></option>
                    <option value="">Non-Highlight</option>
                    @foreach($highlight as $highlight)
                    <option value="{{$highlight->id}}">{{$highlight->highlight_name}}</option>
                    @endforeach
                    </select></td>
            </tr>
            <tr>
                <td class='col-md-2'>Description</td>
                <td class='col-md-6'><input type="text" name="description" class='form-control'></td>
            </tr>
            <tr>
                <td class='col-md-2'></td>
                <td class='col-md-6'>{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}</td>
            </tr>       
        </table>
{!! Form::close() !!}
@endsection
