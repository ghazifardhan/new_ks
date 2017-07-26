@extends('layouts.app')
@section('content')
<div class="left">
	<h3>Input Transaction</h3>
	{!! Form::model(new App\Transaction, ['route' => ['invoice.transaction.store', $invoice->id], 'class' => 'form-horizontal']) !!}
        <br/>
        <br/>
        <div id="myTable">
        <div class="panel panel-default">
        <div class="panel-heading">Item 1</div>
        <div class="panel-body">
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Item Name</td>
				<td><select id="item1" data-placeholder="Choose Item" name="item_id[]" class="form-control chosen-select" required>
					<option value=""></option>
					@foreach($item as $row)
					<option value="{{ $row->id }}">{{$row->item_name}}</option>
					@endforeach
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><div id="result1"><div class="input-group"><input type="number" name="item_qty[]" class="form-control" required/><span class="input-group-addon" id="basic-addon2"></span></div></div></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><div class="input-group"><input type="number" name="discount[]" class="form-control" aria-describedby="basic-addon2" value="0"/>
					<span class="input-group-addon" id="basic-addon2">%</span></div>
				</td>
			</tr>
			<tr>
				<td>Potongan</td>
				<td><input type="number" name="deduction[]" class="form-control" value="0"/></div>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description[]" class="form-control"/></td>
			</tr>
            
        </table>
        </div></div></div>
        <tr>
            <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            <td><button type="button" class="btn btn-success add-btn-transaction" style="margin-top: -7px; padding: -2px; float: right;"><span class='glyphicon glyphicon-plus'></span> Add Item</button></td>
        </tr>
    {!! Form::close() !!}
</div>
@stop
@section('script')
<script type="text/javascript">
    var x = 1;
    getData(x);
    addMoreField();
    getUnit(x);

    function getData(x){
            $.ajax({ 
            type: 'GET', 
            url: 'http://keranjangsayur.com/invoice/new_ks/public/itemJson',
            data: {get_param: 'value'},
            dataType: 'json',
            success: function (data) { 
                $('select[id="item'+x+'"]').empty();
                $('select[id="item'+x+'"]').append($('<option>').text(""));
                $.each(data, function(index, element) {
                    $('select[id="item'+x+'"]').append($('<option>').text(element.item_name).attr('value', element.id));
                });
            $('.chosen-select').chosen({width : "300px"});
            }
        });
        }
    
        function getUnit(i){
        $('select[id="item'+i+'"]').change(function() {
            var x = $(this).val();

            $.ajax({ 
                    type: 'GET', 
                    url: 'http://keranjangsayur.com/invoice/new_ks/public/unitJson',
                    data: {item_id: x},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function(index, element) {
                            $('div[id="result'+i+'"]').html('<div class="input-group"><input type="number" name="item_qty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                        });
                    }
                });
        });
        }
        
        function getUnit2(i){
        $('select[id="item'+i+'"]').change(function() {
            var x = $(this).val();

            $.ajax({ 
                    type: 'GET', 
                    url: 'http://keranjangsayur.com/invoice/new_ks/public/unitJson',
                    data: {item_id: x},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function(index, element) {
                            $('div[id="result'+i+'"]').html('<div class="input-group"><input type="number" name="item_qty" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                        });
                    }
                });
        });
        }

        function addMoreField(){
            var max_fields  = 100;
            var wrapper     = $("#myTable");
            var add_button  = $(".add-btn-transaction");

            var x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<div class="panel panel-default"><div class="panel-heading">Item '+ x +' <button type="button" class="btn btn-danger remove-field" style="margin-top: -7px; padding: -2px; float: right;">X</button></div><div class="panel-body"><table class="table table-hover table-responsive table-bordered""><tr><td>Item Name</td><td><select id="item'+x+'" data-placeholder="Choose Item" name="item_id[]" class="form-control chosen-select" required></select></td></tr><tr><td>Qty</td><td><div id="result'+x+'"><div class="input-group"><input type="number" name="item_qty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div></div></td></tr><tr><td>Discount</td><td><div class="input-group"><input type="number" name="discount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2" value="0"/><span class="input-group-addon" id="basic-addon2">%</span></div></td></tr><tr><td>Potongan</td><td><input type="number" name="deduction[]" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" value="0"/></div></td></tr><td>Description</td><td><input type="text" name="description[]" class="form-control"/></td></tr></table></div></div>');
                    getData(x);
                    getUnit(x);
                }
            });
            //<div class="input-group"><input type="number" name="itemQty[]" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div>
            $(wrapper).on("click", ".remove-field", function(e){
                e.preventDefault(); $(this).parent().parent().remove(); x--;
            });
        }
</script>
@endsection