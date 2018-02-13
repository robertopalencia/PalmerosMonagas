@extends('layouts.principal')


@section('content')
<h1>Registro de Usuarios</h1>
@include('common.errors')
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('msj2'))
<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
<form action="{{url('agregarusuario')}}" method="post">
{{csrf_field()}}
<div class="col-xs-5">
<div class="form-group">
    <label for="name" class="control-label">Nombre</label>
    <input type="text" name="name" class="form-control" required >
</div></div>
<div class="col-xs-5">
<div class="form-group">
    <label for="email" class="control-label">Correo Electronico</label>
    <input type="text" name="email" class="form-control" required >
</div></div>
<div class="col-xs-5">
<div class="form-group">
    <label for="password" class="control-label">Contraseña</label>
    <input type="password" name="password" class="form-control" required>
</div></div>
<div class="col-xs-5">
<div class="form-group">
    <label for="password-confirm" class="control-label">Introduzca la Contraseña Nuevamente</label>
    <input id='password-confirm'type="password" name="password_confirmation" class="form-control" required >
</div></div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Crear Usuario</button>
    
</div></div></form>
@stop