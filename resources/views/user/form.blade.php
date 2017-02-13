@extends('layouts.app')
@section('content')
<h1>Create New User</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model(new App\User, ['class' => 'form-horizontal', 'route' => 'user.store']) !!}
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td class='col-md-2'>Username</td>
                <td class='col-md-6'><input type="text" name="username" class='form-control'></td>
            </tr>
            <tr>
                <td class='col-md-2'>Name</td>
                <td class='col-md-6'><input type="text" name="name" class='form-control'></td>
            </tr>
            <tr>
                <td class='col-md-2'>Email</td>
                <td class='col-md-6'><input type="email" name="email" class='form-control'></td>
            </tr>
			<tr>
                <td class='col-md-2'>Password</td>
                <td class='col-md-6'><input type="password" name="password" class='form-control'></td>
            </tr>
            <tr>
            <td class='col-md-2'>Level</td>
            <td class='col-md-6'><select data-placeholder="Choose Level" name="level" class="form-control">
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    </select>
                    </td>
            </tr>
            <tr>
                <td class='col-md-2'></td>
                <td class='col-md-6'><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    {!! Form::close() !!}
@endsection
