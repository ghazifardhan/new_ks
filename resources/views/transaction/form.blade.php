@extends('layouts.app')
@section('content')
<div class="left">
	<h3>Input Transaction</h3>
	{!! Form::model(new App\Transaction, ['route' => ['invoice.transaction.store', $invoice->id], 'class' => 'form-horizontal']) !!}
        <br/>
        <div id="myTable">
				<?php for($i=1;$i<=$form;$i++){?>
        <div class="panel panel-default">
        <div class="panel-heading" data-id="<?php echo $i;?>">Item {{ $i }} <?php if($i >= 2){?><button type="button" class="btn btn-danger remove-field" style="margin-top: -7px; padding: -2px; float: right;">X</button><?php } ?></div>
        <div class="panel-body">
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Item Name</td>
				<td><select onchange="getval(this, {{ $i }});" id="item<?php echo $i;?>" data-placeholder="Choose Item" name="item_id[]" class="form-control chosen-select" required>
					<option value=""></option>
					@foreach($item as $row)
					<option value="{{ $row->id }}">{{$row->item_name}}</option>
					@endforeach
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><div class="input-group"><input type="number" name="item_qty[]" class="form-control" required/><span class="input-group-addon" id="result<?php echo $i;?>"></span></div></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><div class="input-group"><input type="number" name="discount[]" class="form-control" aria-describedby="basic-addon2" value="0"/>
					<span class="input-group-addon" id="basic-addon2">%</span></div>
				</td>
			</tr>
			<tr>
				<td>Potongan</td>
				<td><input type="number" name="deduction[]" class="form-control" value="0"/>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description[]" class="form-control"/></td>
			</tr>

        </table>
        </div></div>
				<?php } ?>
				</div>
        <tr>
            <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            <td><button type="button" class="btn btn-success add-btn-transaction" style="margin-top: -7px; padding: -2px; float: right;"><span class='glyphicon glyphicon-plus'></span> Add Item</button></td>
        </tr>
    {!! Form::close() !!}
</div>
@stop
@section('script')
<script type="text/javascript">
    //getData();
    addMoreField();

		function getval(sel, row){
			console.log(sel.value + " - " + row);
			getUnit(sel.value, row);
		}

    function getData(){
            $.ajax({
            type: 'GET',
            url: '{{ url("itemJson") }}',
            data: {get_param: 'value'},
            dataType: 'json',
            success: function (data) {
                $('select').empty();
                $('select').append($('<option>').text(""));
                $.each(data, function(index, element) {
                    $('select').append($('<option>').text(element.item_name).attr('value', element.id));
                });
            $('.chosen-select').chosen({width : "300px"});
            }
        });
    }

		function getUnit(id, row){
			var x = id;
			var i = row;
			$.ajax({
							type: 'GET',
							url: '{{ url("unitJson") }}',
							data: {item_id: x},
							dataType: 'json',
							success: function (data) {
									$('span[id="result'+i+'"]').text(data.unit_name);
									console.log(data.unit_name);
							}
					});
		}

    function addMoreField(){
        var max_fields  = 100;
        var wrapper     = $("#myTable");
        var add_button  = $(".add-btn-transaction");

        var x = 10;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append('
								<div class="panel panel-default"><div class="panel-heading">Item '+ x +' <button type="button" class="btn btn-danger remove-field" style="margin-top: -7px; padding: -2px; float: right;">X</button></div><div class="panel-body">
										<table class="table table-hover table-responsive table-bordered">
											<tr>
												<td>Item Name</td>
												<td><select onchange="getval(this, '+x+');" id="item'+x+'" data-placeholder="Choose Item" name="item_id[]" class="form-control chosen-select" required></select>
												</td>
											</tr>
											<tr>
												<td>Qty</td>
												<td>
													<div id="result'+x+'">
														<div class="input-group">
															<input type="number" name="item_qty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required />
															<span class="input-group-addon" id="basic-addon2"></span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>Discount</td>
												<td>
													<div class="input-group">
														<input type="number" name="discount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2" value="0"/>
														<span class="input-group-addon" id="basic-addon2">%</span>
													</div>
												</td>
											</tr>
											<tr>
												<td>Potongan</td>
												<td><input type="number" name="deduction[]" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" value="0"/></td>
											</tr>
											<tr>
												<td>Description</td>
												<td><input type="text" name="description[]" class="form-control"/></td>
											</tr>
										</table>
									</div>
								</div>
								');
                getData();
            }
        });
        //<div class="input-group"><input type="number" name="itemQty[]" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div>
        $(wrapper).on("click", ".remove-field", function(e){
            e.preventDefault(); $(this).parent().parent().remove(); x--;
        });
    }
</script>
@endsection
