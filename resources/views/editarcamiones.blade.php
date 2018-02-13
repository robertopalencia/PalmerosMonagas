@extends('layouts.principal')


@section('content')
<h1>Actualización de Vehiculo</h1>

<form action="{{url('tablacamiones')}}/{{$camion->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="nombre" class="control-label" >Nombre del Chofer</label>
    <input type="text" name="nombre" class="form-control" value="{{$camion->nombre}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="cedula" class="control-label">Cedula de Identidad del Chofer</label>
    <input type="text" name="cedula" class="form-control" value="{{$camion->cedula}}" readonly="readonly" >
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="telefono" class="control-label">Numero de Telefono</label>
    <input type="text" name="telefono" class="form-control"  value="{{$camion->telefono}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="placa" class="control-label">Placa del Vehiculo</label>
    <input type="text" name="placa" class="form-control" value="{{$camion->placa}}" readonly="readonly" >
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="peso" class="control-label">Peso del Vehiculo sin carga en KG</label>
    <input type="text" name="peso" class="form-control" value="{{$camion->peso}}" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil" ></i> Editar Vehiculo</button>
    
</div>
</div>
</form>
@stop