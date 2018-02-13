@extends('layouts.principal')


@section('content')
<h1>Precio</h1>
<form action="{{url('agregarprecio')}}" method="POST">
{{csrf_field()}}
<div class="col-xs-5">
<div class="form-group">
    <input type="number"  name="precio" class="form-control" >
</div>
</div>
<div class="form-group">
   
     <button type="submit" class='btn btn-info'><i class="fa fa-plus"></i> Agregar Nuevo Precio</button>
    
</div>
</form>
@stop