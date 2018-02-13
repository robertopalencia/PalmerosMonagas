@extends('layouts.principal')


@section('content')
<h1>Registro de Cupos</h1>
<form action="{{url('agregarcupos')}}" method="post">
{{csrf_field()}}
@include('common.errors')
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('msj2'))
<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad del Productor</label>
    <input type="text" name="cedula" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="fecha" class="control-label">Fecha a Reservar</label>
    <input type="date" min="{{$fecha}}" name="fecha" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="peso" class="control-label">Carga en KG</label>
    <input type="text" name="peso" class="form-control" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> AGREGAR</button>
    
</div>
</div>
</form>
@stop