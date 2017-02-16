@extends('layouts.app')
@section('content')
<br/>
<a href="{{ route('customer.voucher.create', $customer->id) }}" class="btn btn-primary">Add Voucher</a>
    <h1>Voucher</h1>
    <br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Invoice</th>
            <th>Status</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        @foreach($voucher as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('customer.voucher.destroy', $customer->id, $row->id))) !!}
            <td>{{ $row->invoice_code }}</td>
            <td><?php if($row->is_used==1){echo 'Used';}else{echo 'Unused';} ?></td>
            <td><?php if($row->is_debit==1){echo $row->credit;} ?></td>
            <td><?php if($row->is_debit==0){echo $row->credit;} ?></td>
            <td>{{ $row->description }}</td>
            <td>
            
            <!-- update button -->
            <a href="{{ route('customer.voucher.edit', [$customer->id, $row->id]) }}" class="btn btn-info">Edit</a>
                
            <!-- delete button -->
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
            </td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
@endsection