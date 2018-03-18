@extends('layouts.principal')


@section('content')
<h1>Actualización del Productor</h1>
<form action="{{url('tablaproductores')}}/{{$productor->id}}" method="post">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="nombre" class="control-label">Nombre y Apellido</label>
    <input type="text" name="nombre" class="form-control" value="{{$productor->nombre}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad</label>
    <input type="text" name="cedula" class="form-control" value="{{$productor->cedula}}" readonly="readonly">
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="rif" class="control-label">RIF</label>
    <input type="text" name="rif" class="form-control" value="{{$productor->rif}}" readonly="readonly">
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="finca" class="control-label">Nombre de la Finca</label>
    <input type="text" name="finca" class="form-control" value="{{$productor->finca}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="type" class="control-label">Localidad</label>
    <select name="localidad" class="form-control" required>
      <option value=""></option>
      <option value="hormiga">La Hormiga</option>
      <option value="vueltalarga">Vuelta Larga</option>
    </select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="direccion" class="control-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{$productor->direccion}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="correo" class="control-label">Correo Electronico</label>
    <input type="text" name="correo" class="form-control"  value="{{$productor->correo}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Telefono</label>
    <input type="text" name="telefono" class="form-control"  value="{{$productor->telefono}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil"></i> Editar Productor</button>
    
</div>
</div>
</form>
@stop