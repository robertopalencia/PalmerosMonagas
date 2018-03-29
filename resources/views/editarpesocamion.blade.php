@extends('layouts.principal')


@section('content')
<h1>Tara</h1>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">
        {{session('msj')}}
         
</div>
Nota: En caso de que esta carga no sea de hoy, regrese una pagina con el navegador y recargue con F5
<br><br>
<button type="submit" class="btn btn-success btn" onclick="location.href='/control';">
                         <i class="fa fa-arrow-left" ></i> ATRAS
                    </button> <br> <br>

@endif
<form action="{{url('editarpesocamion')}}/{{$peso->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="real" class="control-label" >Tara del Camion Placas {{$camion->placa}}</label>
    <input type="number" step="0.01" name="real" class="form-control" value="{{$peso->peso}}">
</div>
</div>


<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil" ></i> Editar Tara</button>
    
</div>
</div>
</form>
@stop