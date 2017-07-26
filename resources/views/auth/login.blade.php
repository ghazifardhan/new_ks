<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Keranjang Sayur</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="css/keranjangsayur.css">
        <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
        <!-- Custom CSS -->
        <style type="text/css">
        </style>
      
    </head>

<body>
<div class="container">
<br/>
<br/>
<center><img src="images/ks_2.PNG" />
</center>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
    <center><table class='table table-hover table-responsive table-bordered table-nonfluid'>
        <tr>
            <td>Username</td>
            <td><input name="username" type="text" class="form-control" required />
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input name="password" type="password" class="form-control" required/>
                @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submit" class='btn btn-primary'>Login</button></td>
        </tr>
    </table></center>
</form>
</div>
<!-- jQuery library -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>  
</body>
</html> 