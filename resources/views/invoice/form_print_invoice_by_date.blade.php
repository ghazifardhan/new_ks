@extends('layouts.app')
@section('content')
<h2>Export Invoice</h2>
{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('print_invoice_by_date'))) !!}
        <table class='table table-hover table-responsive table-bordered table-nonfluid'>
            <tr>
                <td>From Date</td>
                <td><input id="date1" type="date" name="date1" class='form-control'></td>
            </tr>
            <tr>
                <td>To Date</td>
                <td><input id="date2" type="date" name="date2" class='form-control'></td>
            </tr>
            <tr>
                <td>Output</td>
                <td><select class="form-control" name="output">
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class="btn btn-success">Submit</button></td>
            </tr>     
        </table>    
@endsection