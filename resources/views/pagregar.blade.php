@extends('layouts.principal')


@section('content')
<h1>Pesaje</h1>
@include('common.errors')
@if(session()->has('msj'))
<div class="col-xs-11">
<form action="{{url('pdfcarga')}}" method="POST" class="navbar-form navbar-left">
{{csrf_field()}}
<div class="alert alert-success" role="alert">{{session('msj')}}
<input type="hidden" name="peso" class="form-control" value="{{session('peso')}}">
<input type="hidden" name="carga" class="form-control" value="{{session('carga')}}">
<input type="hidden" name="precio" class="form-control" value="{{session('precio')}}">
<input type="hidden" name="cedula" class="form-control" value="{{session('cedula')}}">
<input type="hidden" name="nombre" class="form-control" value="{{session('nombre')}}">
<input type="hidden" name="placa" class="form-control" value="{{session('placa')}}">
<button type="submit" class='btn btn'><i class="fa fa-print"></i> <strong>Imprimir</strong></button>

       
       
    
</div>

</form> 
</div>
@endif
@if(session()->has('msj2'))
<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
@endif
@if(session()->has('msj3'))
<div class="alert alert-danger" role="alert">{{session('msj3')}}</div>
@endif
<form action="{{url('agregarcarga')}}" method="post">
{{csrf_field()}}
<div class="col-xs-5">
<div class="form-group">
    <label for="carga" class="control-label">Carga en KG</label>
    <input type="text" name="carga" class="form-control" required >
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="descripcion" class="control-label">Descripción</label>
    <input type="text" name="descripcion" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="placa" class="control-label">Placa Vehiculo</label>
    <input type="text" name="placa" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad Productor</label>
    <input type="text" name="cedula" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Cargar Pesaje</button>
    
</div>
</div>
</form>
@stop