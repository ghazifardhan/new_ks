@extends('layouts.app')
@section('content')
<h1>Create New Customer</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model($customer, ['method' => 'PATCH', 'route' => ['customer.update', $customer->id], 'class' => 'form-horizontal']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Customer Name</td>
                <td><input type="text" name="customer_name" class='form-control' value="{{ $customer->customer_name }}"></td>
            </tr>
            <tr>
                <td>Customer Type</td>
                <td><select class="form-control" name="customer_type">
                    @foreach($customer_type as $row)
                    <option value="{{ $row->id }}" <?php  if($row->id == $customer->customer_type){ echo 'selected';} ?>>{{ $row->type }}</option>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="{{ $customer->description }}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
@endsection