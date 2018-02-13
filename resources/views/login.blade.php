@extends('layouts.auth')
@section('content')
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>


<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
   <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body>

<div class="form-wrap col-md-5 auth-form" id="login">


<h1>Autenticación</h1>
<!--<form role="form" action="{url('login.store')}}" method="post" autocomplete="off"  id="login-form">
{csrf_field()}}-->

{!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}

<div class="form-group input-icon">

    <label for="user" class="control-label">Usuario</label>
    <input type="text" name="user" class="form-control">
</div>
<div class="form-group password-field input-icon">


    <label for="password" class="control-label">Contraseña</label>
    <input type="password" name="password" class="form-control" >
</div>



<div class="form-group">
   <br>
    <button type="submit" class="btn btn-info btn-lg btn-block" id="btn-login">ENTRAR</button>
    
</div>
{!!Form::close()!!}
@include('common.errorlogin')

<!--</form>-->
</div>
<script src="{{('js/jquery.min.js')}}"></script>
    <script src="{{('js/bootstrap.min.js')}}"></script>
    <script src="{{('js/metisMenu.min.js')}}"></script>
    <script src="{{('js/sb-admin-2.js')}}"></script>

</body>

</html>

@stop
