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
  @if (count($gandolas)>1)
   <form action="{{url('buscarcontrolfechagandola')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}
<div class="form-group">
   
    <input type="hidden"  name="fecha" class="form-control" value="{{$fecha2}}">
</div>
<div class="form-group">
     <label for="id" class="control-label">Gandolas</label>
    <select name="id" class="form-control" required>
    <option value=""></option>
    <?php $id=0; ?>
     @foreach($gandolas as $gandola)
      @if($id!=$gandola->cargagandola_id)
      <?php $id=$gandola->cargagandola_id;?>
       <option value="{{$gandola->cargagandola_id}}">{{$gandola->placa}}</option>
       @endif
   @endforeach
    </select> 
</div>


<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> FILTRO</button>
    
</div>
</form>   
   @endif   
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
                @if(Auth::user()->hasRole('admin'))
                <th>Monto</th>
                @endif
                <th>Acciones</th>
                
            </thead>
            <tbody> 
                @foreach($controles as $control)
               
                <tr>
                  
                    <td class="table-text"><div> {{$control->nombre}} </div></td>
                    
                    <td class="table-text"><div> {{$control->placa}} </div></td>
                   
                   
                    <td class="table-text"><div> {{number_format($control->peso, 0, ",",".")}}Kg </div></td>
                    
                    <td class="table-text"><div> {{number_format($control->carga-$control->peso-$control->descuento, 0,",",".")}}Kg </div></td>
                   <td class="table-text"><div> {{number_format($control->descuento, 0, ",",".")}}Kg </div></td>
                    @if(Auth::user()->hasRole('admin')) 
                    <td class="table-text"><div> {{number_format((($control->carga-$control->peso-$control->descuento)/1000)*$control->precio, 2,",",".")}} BsF 
                    </div>
                    </td>
                    @endif
                     <td>
                     
                       <button type="submit" class="btn btn-success btn-xs" onclick="location.href='editarpesorecibo/{{$control->pid}}';" style="Float:left">
                         Descuento
                    </button>
                   
                    
                     
                     
                       <button type="submit" class="btn btn-info btn-xs" onclick="location.href='editarpesocamion/{{$control->pid}}';" style="Float:left">
                         Tara
                    </button>
                   
                    
                        <form action="{{url('pdfcarga')}}" method="POST" class="navbar-form navbar-left" style="Float:left">
{{csrf_field()}}
                <input type="hidden" name="peso" class="form-control" value="{{$control->peso}}">
                <input type="hidden" name="carga" class="form-control" value="{{$control->carga}}">
                <input type="hidden" name="descuento" class="form-control" value="{{$control->descuento}}">
                <input type="hidden" name="precio" class="form-control" value="{{$control->precio}}">
                <input type="hidden" name="rif" class="form-control" value="{{$control->rif}}">
                <input type="hidden" name="nombre" class="form-control" value="{{$control->finca}}">
                <input type="hidden" name="cod" class="form-control" value="{{$control->cod}}">
                <input type="hidden" name="chofer" class="form-control" value="{{$control->nombre}}">
                <input type="hidden" name="cedula" class="form-control" value="{{$control->cedula}}">
                <input type="hidden" name="placa" class="form-control" value="{{$control->placa}}">
                <input type="hidden" name="id" class="form-control" value="{{$control->pid}}">
                <input type="hidden" name="entrada" class="form-control" value="{{$control->entrada}}">
                <input type="hidden" name="salida" class="form-control" value="{{$control->salida}}">
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
                    @if(Auth::user()->hasRole('admin'))
                    <td class="table-text"><div><h4><strong> Monto Total</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong> {{number_format($total, 2, ",",".")}}BsF</strong> </h4></div>
                    </td>
                    @endif
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