@extends('layouts.principal')


@section('content')
<h1>Precio</h1>
<form action="{{url('agregarprecio')}}" method="POST">
{{csrf_field()}}
<div class="col-xs-5">
<div class="form-group">
   <label for="preciocontado" class="control-label">Precio a Contado</label>
    <input type="number"  name="preciocontado" class="form-control" required>
</div>
</div>
<div class="col-xs-5">
<div class="form-group">
   <label for="preciocredito" class="control-label">Precio a Credito</label>
    <input type="number"  name="preciocredito" class="form-control" required>
</div>
</div>
<div class="form-group">
   
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Agregar Nuevos Precio</button>
    
</div>
</form>
@stop