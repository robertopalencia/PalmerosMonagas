@extends('layouts.principal')


@section('content')
<h1>Pesos</h1>

<form action="{{url('pesos')}}/{{$gandola->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="real" class="control-label" >Peso Real</label>
    <input type="text" name="real" class="form-control" value="{{$gandola->peso_real}}">
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="destino" class="control-label">Peso Destino</label>
    <input type="text" name="destino" class="form-control" value="{{$gandola->peso_mermado}}">
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil" ></i> Editar Pesos</button>
    
</div>
</div>
</form>
@stop