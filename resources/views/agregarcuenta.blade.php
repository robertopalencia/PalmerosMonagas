@extends('layouts.principal')


@section('content')
<h1>Registro de Cuentas Bancarias</h1>
<form action="{{url('agregarbanco')}}" method="post">
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
    <input type="text" name="cedula" class="form-control">
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="banco" class="control-label">Banco</label>
    <input type="text" name="banco" class="form-control">
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="cuenta" class="control-label">Número de Cuenta</label>
    <input type="text" name="cuenta" class="form-control">
</div>
</div>



<div class="col-xs-5">
<div class="form-group">
    <label for="tipo" class="control-label">Tipo de Titular</label>
     <select name="tipo" class="form-control" >
    <option value=""> </option>
  <option value="Personal">Natural</option>
    <option value="Juridico">Juridico</option>
  
</select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="tipocuenta" class="control-label">Tipo de Cuenta</label>
     <select name="tipocuenta" class="form-control" >
     <option value=""> </option>
  <option value="Ahorro">Ahorro</option>
  <option value="Corriente">Corriente</option>

</select> 
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