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
    <label for="cedula" class="control-label">Cedula de Identidad</label>
    <div class="input-group">
    <select name="nacionalidad" class="form-control" required>
     <option value=""></option>
     <option value="E">E</option>
     <option value="V">V</option>
    </select>
    <span class="input-group-addon">-</span> 
    <input type="text" name="cedula" class="form-control"  value="{{old('cedula')}}" required>
    </div>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="fecha" class="control-label">Fecha a Reservar</label>
    <input type="date" min="{{$fecha}}" name="fecha" class="form-control" value="{{old('fecha')}}" required>
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="peso" class="control-label">Carga en KG</label>
    <input type="text" name="peso" class="form-control" value="{{old('peso')}}" required>
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