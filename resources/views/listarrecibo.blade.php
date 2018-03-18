@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    

    <div class="panel panel-default">
        <div class="panel-heading"><strong>RECIBO</strong></div>
    <div class="panel-body">
       
    <form action="{{url('buscarreciboproductor')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

<div class="form-group">
   
    <input type="text"  name="nombre" class="form-control" placeholder="Cedula o RIF" >
</div>


<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR</button>
    
</div>
</form>   
    @if(count($pesaje)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert"><strong>{{$msj}}</strong></div></div>
@endif
   @if(count($productor)>0)
      <div class="pull-left">
       
       <strong>{{$productorfinca}}</strong> <br><strong>RIF:</strong>
       {{$productorrif}} <br>
       <strong>Dirección: </strong>{{$productordir}} <br>
       <strong>Representante: </strong> <br>
       <strong>{{$productornombre}}</strong> <br>
       <strong>C.I.:</strong>{{$productorcedula}} <br>
       
       <strong>Email: </strong>{{$productorcorreo}} <br>
       
       </div>
       @endif
       @if (count($pesaje)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Fecha</th>
                <th>Carga en Tonelada</th>
                <th>Descripcion</th>
                <th>Monto Bs.F</th>
                
            </thead>
            <tbody> 
                @foreach($pesaje as $pesajes)
                 
               
               
               
                <tr>
                   <?php $fecha=date_create($pesajes->fecha)?>
                    <td class="table-text"><div> {{date_format($fecha, "d-m-Y")}} </div></td>
                    <td class="table-text"><div> {{neto($pesajes->carga/1000,$pesajes->peso/1000,$pesajes->descuento/1000, 2)}} </div></td>
                    <td class="table-text"><div> {{$pesajes->descripcion}} </div></td>
                    <td class="table-text"><div> {{totalPrecio((($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000),$pesajes->precio, 2)}} </div></td>
                   
                     <td>
                     
                       <button type="submit" class="btn btn-success btn-xs" onclick="if (confirm('¿Confirma, que este RECIBO fue cancelado?')) window.location.href='editarrecibo/{{$pesajes->id}}';">
                        <i class="fa fa-credit-card"></i> Pagado
                    </button>
                   
                    </td>
                      
                     <td>
                     
                       <button type="submit" class="btn btn-success btn-xs" onclick="location.href='editarpesorecibo/{{$pesajes->id}}';">
                         Descuento
                    </button>
                   
                    </td>
                    <td>
                    <form action="{{url('pdfid')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}


    <input type="hidden"  name="cedula" class="form-control" value="{{$productorcedula}}" >
    <input type="hidden"  name="id" class="form-control" value="{{$pesajes->id}}" >


 @if(count($pesaje)>0)
<div class="form-group">
       <button type="submit" class='btn btn-xs'><i class="fa fa-print"></i></button>
    
</div>
@endif
</form> 
               </td>
                </tr>
                
                @endforeach
               
                <tr>
                 <td class="table-text"><div></div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div><h4><strong>Monto Total</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong> {{number_format($total, 2, ",",".")}} Bs.F</strong></h4></div></td>
                    <td class="table-text"><div> </div></td>
                    </tr>
            </tbody>
        </table>
        
       
        <h2><strong>Cuentas Bancarias del Productor</strong></h2>
        @foreach($banco as $bancos)
        <h4><strong>{{$bancos->banco}}</strong> Cuenta {{$bancos->tipocuenta}} {{$bancos->tipo}} <strong>{{$bancos->cuenta}}</strong></h4>
        @endforeach
    </div>
    </div>
    @endif
</div>


<form action="{{url('pdf')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

<div class="form-group">
   
    <input type="hidden"  name="nombre" class="form-control" value="{{$productorcedula}}" >
</div>

 @if(count($pesaje)>0)
<div class="form-group">
       <button type="submit" class='btn btn'><i class="fa fa-print"></i> <strong>Imprimir</strong></button>
    
</div>
@endif
</form> 

@stop