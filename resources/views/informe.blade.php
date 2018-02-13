@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    
     @if($pago==0)
    <div class="panel panel-default">
        <div class="panel-heading"><strong>INFORME DE RECIBOS POR PAGAR</strong></div>
    <div class="panel-body">
      @endif
      @if($pago==1)
       <div class="panel panel-default">
        <div class="panel-heading"><strong>INFORME DE RECIBOS PAGADOS POR DIA</strong></div>
    <div class="panel-body">
       @endif
    <form action="{{url('buscarreciboproductor')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

<div class="form-group">
   
    <input type="text"  name="nombre" class="form-control" placeholder="Cedula o RIF" >
</div>


<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR RECIBOS</button>
    
</div>
</form> 
    <form action="{{url('buscarrecibopagados')}}" method="POST" class="navbar-form navbar-left pull-left">
{{csrf_field()}}
<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR PAGADOS</button>
    
</div>
<div class="form-group">
   
    <input type="date"  name="nombre" class="form-control">
</div>
</form>    
    @if(count($productor)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert"><strong>{{$msj}}</strong></div></div>
@endif
   
       @if (count($productor)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Nombre</th>
                <th>C.I. o RIF</th>
                <th>Banco</th>
                <th>Tipo</th>
                <th>Cuenta Bancaria</th>
                <th>Carga</th>
                <th>Monto Total C/P</th>
                
            </thead>
            <tbody> 
                @foreach($productor as $var)
                 <?php
                if($precio!=$var->precio){
                    $precio=$var->precio;
                    $cedula=0;
                }?>
               @if($cedula!=$var->cedula)
               <?php $cedula=$var->cedula;
               
                ?>
               
                <tr>
                   @if($var->tipo=='Juridico')
                    <td class="table-text"><div> {{$var->finca}} </div></td>
                    @else
                    <td class="table-text"><div> {{$var->nombre}} </div></td>
                    @endif
                    @if($var->tipo=='Juridico')
                    <td class="table-text"><div> {{$var->rif}} </div></td>
                    @else
                    <td class="table-text"><div> {{$var->cedula}} </div></td>
                    @endif
                     <td class="table-text"><div> {{$var->banco}} </div></td>
                      <td class="table-text"><div> {{$var->tipocuenta}} </div></td>
                    <td class="table-text"><div> {{$var->cuenta}} </div></td>
                   
                    <td class="table-text"><div> {{number_format(($var->pcarga-$var->ppeso)/1000, 2,",",".")}} </div></td>
                   
                    <td class="table-text"><div> {{number_format((($var->pcarga-$var->ppeso)/1000)*$var->precio, 2, ",",".")}} </div></td>
                   
                     
                </tr>
                @endif
                @endforeach
               
                <tr>
                 <td class="table-text"><div></div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div><h4><strong>Monto Total</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong>  {{number_format($total, 2, ",",".")}}</strong></h4></div></td>
                    <td class="table-text"><div> </div></td>
                    </tr>
            </tbody>
        </table>
        
       
        
    </div>
    </div>
    @endif
</div>
@if(count($productor)>0)
     @if($pago==0)
<form action="{{url('pdfinforme')}}" method="GET" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

 
<div class="form-group">
       <button type="submit" class='btn btn'><i class="fa fa-print"></i> <strong>Imprimir</strong></button>
    
</div>

</form> 
@else
<form action="{{url('pdfinformepagos')}}" method="GET" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

 <input type="hidden" value="{{$fecha}}" name="fecha">
<div class="form-group">
       <button type="submit" class='btn btn'><i class="fa fa-print"></i> <strong>Imprimir</strong></button>
    
</div>

</form> 
@endif
@endif
@stop