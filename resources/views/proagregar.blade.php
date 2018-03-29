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
    <label for="nombre" class="control-label">Nombre y Apellido</label>
    <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad</label>
    <div class="input-group">
    <select name="nacionalidad" class="form-control" required>
     <option value=""></option>
     <option value="E">E</option>
     <option value="V">V</option>
    </select>
    <span class="input-group-addon">-</span> 
    <input type="number" value="{{old('cedula')}}" name="cedula" class="form-control" required>
    </div>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="rif" class="control-label">RIF</label>
    <div class="input-group">
    <select name="letra" class="form-control" required>
     <option value=""></option>
     <option value="C">C</option>
     <option value="E">E</option>
     <option value="G">G</option>
     <option value="J">J</option>
     <option value="P">P</option>
     <option value="V">V</option>
    </select>
    <span class="input-group-addon">-</span> 
    <input type="number" value="{{old('rif')}}" name="rif" class="form-control" required>
    </div>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="finca" class="control-label">Nombre de Juridico</label>
    <input type="text" name="finca" value="{{old('finca')}}" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="localidad" class="control-label">Localidad</label>
    <select name="localidad" class="form-control" required>
      <option value=""></option>
      <option value="Aguila">Águila</option>
      <option value="Cachipo">Cachipo</option>
      <option value="Caripito">Caripito</option>
      <option value="El Barril">El Barril</option>
       <option value="El Zamuro">El Zamuro</option>
      <option value="La Hormiga">La Hormiga</option>
      <option value="Pica June">Pica June</option>
      <option value="San Augustin">San Augustin</option>
      <option value="Vivoral">Vivoral</option>
      <option value="Vuelta Larga">Vuelta Larga</option>
    </select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="direccion" class="control-label">Dirección</label>
    <input type="text" value="{{old('direccion')}}" name="direccion" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Telefono</label>
    <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="direccion" class="control-label">Banco</label>
    <input type="text" name="banco" value="{{old('banco')}}" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cuenta" class="control-label">Cuenta Nº</label>
    <input type="text" name="cuenta" value="{{old('cuenta')}}" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="correo" class="control-label">Correo Electronico</label>
    <input type="text" name="correo" value="{{old('correo')}}" class="form-control" required>
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