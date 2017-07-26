@extends('layouts.app')
@section('content')
<h1>User</h1>
	<div class="input-group">
      <input type="text" id="search-box-user" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button class="btn btn-default btn-search-user">Search</button>
	  </span>
    </div><!-- /input-group -->
    <br/>
	<button class="btn btn-primary btn-create-user">Create User</button>
	<br/>
	<br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>UserId</th>
            <th>Username</th>
            <th>Level</th>
            <th>Option</th>
        </tr>
        @foreach($user as $row)
        <tr>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('user.destroy', $row->id))) !!}
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->level; ?></td>
            <td>
                <div class="userId display-none"><?php echo $row->user_id; ?></div>

                <!-- update button -->
                {!! link_to_route('category.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) !!}
                    
                <!-- delete button -->
                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}  
            </td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
    <center>
    {{ $user->render() }}
    </center>
@endsection