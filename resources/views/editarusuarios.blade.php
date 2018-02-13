@extends('layouts.principal')


@section('content')
<h1>Actualización de Usuarios</h1>
<form action="{{url('users')}}/{{$users->id}}" method="post">
{{csrf_field()}}
{{method_field ('PUT')}} 
@include('common.errors')
<div class="col-xs-5">
<div class="form-group">
    <label for="password" class="control-label">Contraseña</label>
    <input type="password" name="password" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="password-confirm"  class="control-label">Introduzca la Contraseña Nuevamente</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
</div>
</div>
<input id="email" type="hidden" class="form-control" name="email" value="{{$users->email}}">
<input id="name" type="hidden" class="form-control" name="name" value="{{$users->name}}">
<div class="col-xs-3">
<div class="form-group">
   
     <button type="submit" class='btn btn-success'><i class="fa fa-new"></i> Cambiar Contraseña</button>
    
</div>
</div>
</form>
@stop