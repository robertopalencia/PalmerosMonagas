@extends('layouts.principal')


@section('content')
<div align="center"><h1>Actualización Cuenta del {{$banco->banco}} <br>del Productor {{$productor->nombre}}</h1></div>
<form action="{{url('banco')}}/{{$banco->id}}" method="post">
{{csrf_field()}}
{{method_field ('PUT')}} 

<div class="col-xs-5">
<div class="form-group">
    <label for="banco" class="control-label">Banco</label>
    <input type="text" name="banco" class="form-control" value="{{$banco->banco}}">
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
    <label for="cuenta" class="control-label">Número de Cuenta</label>
    <input type="text" name="cuenta" class="form-control" value="{{$banco->cuenta}}" readonly="readonly">
</div>
</div>



<div class="col-xs-5">
<div class="form-group">
    <label for="tipo" class="control-label">Tipo de Titular</label>
     <select name="tipo" class="form-control" >
    
  <option value="{{$banco->tipo}}">{{$banco->tipo}}</option>
  @if($banco->tipo=="Juridico")
  <option value="Personal">Natural</option>
   @else  <option value="Juridico">Juridico</option>
  @endif
</select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="tipocuenta" class="control-label">Tipo de Cuenta</label>
     <select name="tipocuenta" class="form-control" >
    
  <option value="{{$banco->tipocuenta}}">{{$banco->tipocuenta}}</option>
  @if($banco->tipocuenta=="Corriente")
  <option value="Ahorro">Ahorro</option>
  @else <option value="Corriente">Corriente</option>
  @endif

</select> 
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil"></i> EDITAR</button>
    
</div>
</div>
</form>
@stop