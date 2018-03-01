@extends('layouts.principal')

@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    
   
    <div class="panel panel-default">
        <div class="panel-heading"><strong>CONTROL</strong></div>
    <div class="panel-body">
     
    <form action="{{url('buscarcontrolfecha')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

<div class="form-group">
   
    <input type="date"  name="nombre" class="form-control">
</div>


<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR</button>
    
</div>
</form>    
    @if(count($controles)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert"><strong>{{$msj}}</strong></div></div> <br> <br> <br>
@endif
  
   
       @if (count($controles)>0)
       @if($hoy==1)
       <strong><h3>HOY</h3></strong>
       @else
       <strong><h3>{{date_format($fecha, 'd-m-Y')}}</h3></strong>
       @endif
       
        <table class="table table-striped task-table">
            <thead>
                <th>Productor</th>
                <th>Placa</th>
                <th>Tara</th>
                <th>Carga</th>
                <th>Descuento</th>
                <th>Monto</th>
                
                
            </thead>
            <tbody> 
                @foreach($controles as $control)
               
                <tr>
                  
                    <td class="table-text"><div> {{$control->nombre}} </div></td>
                    
                    <td class="table-text"><div> {{$control->placa}} </div></td>
                   
                   
                    <td class="table-text"><div> {{number_format($control->peso, 0, ",",".")}}Kg </div></td>
                    
                    <td class="table-text"><div> {{number_format($control->carga-$control->peso-$control->descuento, 0,",",".")}}Kg </div></td>
                   <td class="table-text"><div> {{number_format($control->descuento, 0, ",",".")}}Kg </div></td>
                     <td class="table-text"><div> {{number_format((($control->carga-$control->peso-$control->descuento)/1000)*$control->precio, 2,",",".")}} BsF </div></td>
                     <td>
                     
                       <button type="submit" class="btn btn-success btn-xs" onclick="location.href='editarpesorecibo/{{$control->pid}}';">
                         Descuento
                    </button>
                   
                    </td>
                     <td>
                     
                       <button type="submit" class="btn btn-success btn-xs" onclick="location.href='editarpesocamion/{{$control->pid}}';">
                         Tara
                    </button>
                   
                    </td>
                    
                    <td>
                        <form action="{{url('pdfcarga')}}" method="POST" class="navbar-form navbar-left">
{{csrf_field()}}
                <input type="hidden" name="peso" class="form-control" value="{{$control->peso}}">
                <input type="hidden" name="carga" class="form-control" value="{{$control->carga}}">
                <input type="hidden" name="descuento" class="form-control" value="{{$control->descuento}}">
                <input type="hidden" name="precio" class="form-control" value="{{$control->precio}}">
                <input type="hidden" name="cedula" class="form-control" value="{{$control->rif}}">
                <input type="hidden" name="nombre" class="form-control" value="{{$control->finca}}">
                <input type="hidden" name="placa" class="form-control" value="{{$control->placa}}">
                <button type="submit" class='btn btn-xs'>
                    <i class="fa fa-print btn-xs"></i>  
                </button>
            </div>
        </form> 
                    </td>
                     
                </tr>
                
                @endforeach
               
                <tr>
                 <td class="table-text"><div></div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div><h4><strong> Monto Total</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong> {{number_format($total, 2, ",",".")}}BsF</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong> </strong></h4></div></td>
                    <td class="table-text"><div> </div></td>
                    </tr>
            </tbody>
        </table>
        <strong>Nota:</strong> La impresión, son nota de entrega. <br><strong>Al agregar descuento, recargar con F5.</strong>
        @endif
       
        
    </div>
    </div>
    
</div>



@stop