@extends('layouts.principal')


@section('content')
<h1>RECIBO</h1>
<h4>Introduzca RIF o Cedula de Identidad del Productor</h4>
<form action="{{url('buscarreciboproductor')}}" method="POST" class="navbar-form navbar-left pull-left">
{{csrf_field()}}

<div class="form-group">
   
    <input type="text"  name="nombre" class="form-control" placeholder="Cedula o RIF" >
</div>


<div class="form-group">
 
     <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR RECIBOS</button>
    
</div>
</form>
@stop