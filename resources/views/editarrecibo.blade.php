@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    

    <div class="panel panel-default">
        <div class="panel-heading">CONFIRMACION DE PAGO</div>
    <div class="panel-body">
       @if(session()->has('msj'))

<div class="alert alert-success" role="alert">{{session('msj')}}</div>
 <form action="{{url('buscarreciboproductor')}}" method="POST" class="navbar-form navbar-left pull-left">
{{csrf_field()}}

<div class="form-group">
   
    <input type="hidden"  name="nombre" class="form-control" value="{{$productor->cedula}}" >
</div>
  <div class="form-group">
  <button type="submit" class="btn btn-success btn"><i class="fa fa-arrow-left"></i>REGRESAR</button>
   </div>
    </form> 

       @else
        <strong><h3>Esta Seguro que el RECIBO de fecha:  {{$pesaje->fecha}}, con un monto de  @foreach($pesaje2 as $var){{number_format((($pesaje->carga-$pesaje->peso)/1000)*$var->precio, 2, ",",".")}}@endforeach. Ha sido cancelado al Productor: {{$productor->nombre}}.</h3></strong>  
     <div class="col-xs-5">
    <form action="{{url('recibo')}}/{{$pesaje->id}}" method="post">
     {{csrf_field()}}
    {{method_field ('PUT')}} 
       
            <input type="hidden" name="carga" class="form-control" value="{{$pesaje->carga}}">
                <input type="hidden" name="descripcion" class="form-control" value="{{$pesaje->descripcion}}">
                    <input type="hidden" name="pago" class="form-control" value="SI">
                       <input type="hidden" name="peso" class="form-control" value="{{$pesaje->peso}}">
                        <input type="hidden" name="camion_id" class="form-control" value="{{$pesaje->camion_id}}">
                            <input type="hidden" name="productor_id" class="form-control" value="{{$pesaje->productor_id}}">
                                <input type="hidden" name="precio_id" class="form-control" value="{{$pesaje->precio_id}}">
                                    <input type="hidden" name="fecha" class="form-control" value="{{$pesaje->fecha}}">
        
    
     
   
        <div class="form-group">
            <button type="submit" class='btn btn-success'><i class="fa fa-check"></i></button>
        </div>
   
    
    </form>  
    <form action="{{url('buscarreciboproductor')}}" method="POST">
{{csrf_field()}}

<div class="form-group">
   
    <input type="hidden"  name="nombre" class="form-control" value="{{$productor->cedula}}" >
</div>
  <div class="form-group">
  <button type="submit" class="btn btn-danger btn"><i class="fa fa-times"></i></button>
   </div>
    </form>  
                
       </div>        
@endif           
                
  </div>  
   
 </div>
   
</div>
@stop