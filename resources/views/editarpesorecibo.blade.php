@extends('layouts.principal')


@section('content')
<h1>Descuento</h1>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">
        {{session('msj')}}
</div>
@endif
<form action="{{url('editarpesorecibo')}}/{{$peso->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="real" class="control-label" >Descuento (Kg)</label>
    <input type="text" name="real" class="form-control" value="{{$peso->descuento}}">
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