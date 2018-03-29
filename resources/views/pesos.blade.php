@extends('layouts.principal')


@section('content')
<h1>Pesos</h1>

<form action="{{url('pesos')}}/{{$gandola->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="real" class="control-label" >Peso Monagas en Kg</label>
    <input type="number" step="0.01" name="real" class="form-control" value="{{$gandola->peso_real}}">
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
    <label for="destino" class="control-label">Peso Zulia en Kg</label>
    <input type="number" step="0.01" name="destino" class="form-control" value="{{$gandola->peso_mermado}}">
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