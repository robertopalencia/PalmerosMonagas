@extends('layouts.principal')


@section('content')
<h1>Registro de Gandolas</h1>
  @include('common.errors')
@if(session()->has('msj'))

<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('msj2'))

<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
<form action="{{url('agregargandola')}}" method="post">
  {{csrf_field()}} 

<div class="col-xs-5">
<div class="form-group">
    <label for="chofer" class="control-label">Nombre del Chofer</label>
    <input type="text" name="chofer" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad del Chofer</label>
    <input type="text" name="cedula" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Numero de Telefono</label>
    <input type="text" name="telefono" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="placa" class="control-label">Placa del Vehiculo</label>
    <input type="text" name="placa" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="peso" class="control-label">Peso del Vehiculo sin carga en KG</label>
    <input type="text" name="peso" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
   
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Agregar Gandola</button>
    
</div>
</div>
</form>
@stop