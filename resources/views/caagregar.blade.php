@extends('layouts.principal')


@section('content')
<h1>Registro de Camiones</h1>
  @include('common.errors')
@if(session()->has('msj'))

<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('msj2'))

<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
<form action="{{url('agregarcamion')}}" method="post">
  {{csrf_field()}} 

<div class="col-xs-5">
<div class="form-group">
    <label for="nombre" class="control-label">Nombre del Chofer</label>
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
    <input type="number" name="cedula" class="form-control" value="{{old('cedula')}}" required>
    </div>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Numero de Telefono</label>
    <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="placa" class="control-label">Placa del Vehiculo</label>
    <input type="text" name="placa" class="form-control" value="{{old('placa')}}" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="marca" class="control-label">Marca del Vehiculo</label>
    <input type="text" name="marca" class="form-control" value="{{old('marca')}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="modelo" class="control-label">Modelo del Vehiculo</label>
    <input type="text" name="modelo" class="form-control" value="{{old('modelo')}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="color" class="control-label">Color del Vehiculo</label>
    <input type="text" name="color" class="form-control" value="{{old('color')}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="ano" class="control-label">Año del Vehiculo</label>
    <input type="text" name="ano" class="form-control" value="{{old('ano')}}" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="peso" class="control-label">Tara del Vehiculo</label>
    <input type="number" step="0.01" name="peso" class="form-control" value="{{old('peso')}}" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
   
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Agregar Camion</button>
    
</div>
</div>
</form>
@stop