@extends('layouts.app')
@section('content')
<br/>
<div class='jumbotron'>
        <center><img src="{{ asset('/images/ks_2.PNG') }}"/></center>
</div>
<table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Invoice Date</th>
            <th>Total Invoice</th>
            <th>Total IDR</th>
        </tr>
        @foreach($invoice as $row)
        <tr>
            <td>{{ $row->invoice_date }}</td>
            <td>{{ $row->inv }}</td>
            <td>{{ number_format($row->total,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>
    <center>
    {{ $invoice->render() }}
    </center>
@endsection
