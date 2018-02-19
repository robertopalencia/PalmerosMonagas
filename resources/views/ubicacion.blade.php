@extends('layouts.principal')


@section('content')
<h1>Pesos</h1>

<form action="{{url('ubicacion')}}/{{$gandola->id}}" method="POST">
{{csrf_field()}}
{{method_field ('PUT')}} 
<div class="col-xs-5">
<div class="form-group">
    <label for="ubicacion" class="control-label">Ubicacion</label>
     <select name="ubicacion" class="form-control" >
  <option value="Caracas">Caracas</option>
  <option value="Lara">Lara</option>
  <option value="Monagas">Monagas</option>
  <option value="Trujillo">Trujillo</option>
  <option value="Zulia">Zulia</option>
</select> 
</div>
</div>

<div class="col-xs-5">
<div class="form-group">
   <br>
     <button type="submit" class='btn btn-warning'><i class="fa fa-pencil" ></i> Nueva Ubicación</button>
    
</div>
</div>
</form>
@stop