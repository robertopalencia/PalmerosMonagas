@extends('layouts.principal')


@section('content')
<h1>Registro de Productor</h1>
@include('common.errors')
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('msj2'))
<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
<form action="{{url('agregarproductor')}}" method="post">
{{csrf_field()}}
<div class="col-xs-5">
<div class="form-group">
    <label for="nombre" class="control-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad</label>
    <input type="text" name="cedula" class="form-control"  required>
</div> 
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="rif" class="control-label">RIF</label>
    <input type="text" name="rif" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="finca" class="control-label">Nombre de Juridico</label>
    <input type="text" name="finca" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="direccion" class="control-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Telefono</label>
    <input type="text" name="telefono" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="direccion" class="control-label">Banco</label>
    <input type="text" name="banco" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cuenta" class="control-label">Cuenta Nº</label>
    <input type="text" name="cuenta" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="correo" class="control-label">Correo Electronico</label>
    <input type="text" name="correo" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="type" class="control-label">Tipo de Titular</label>
     <select name="tipo" class="form-control" required>
      <option value=""></option>
  <option value="Juridico">Juridico</option>
  <option value="Personal">Natural</option>
</select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="type" class="control-label">Tipo de Cuenta</label>
     <select name="tipocuenta" class="form-control" required>
      <option value=""></option>
  <option value="Corriente">Corriente</option>
  <option value="Ahorro">Ahorro</option>
</select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Agregar Productor</button>
    
</div>
</div>

</form>
@stop