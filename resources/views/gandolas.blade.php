@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Gandolas</div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='agregargandola'"><i class="fa fa-plus"></i>En destino</button>
     <form action="{{url('buscargandola')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
   
    
 
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar Gandola</button>
        </div>
 
    
    </form>
      @if($gandola==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">No hay Gandolas en camino</div></div>
@endif
      @if($gandola>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Chofer</th>
                <th>Placa</th>
                <th>Peso Origen</th>
                <th>Peso Destino</th>
                <th>Peso Real</th>
                <th>Fecha</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </thead>
            <tbody><?php $anterior=0;?>
                @foreach($gandol as $gandola)
                <tr>
                   @if($anterior!=$gandola->cid)
                   <?php $anterior=$gandola->cid; ?>
                    <td class="table-text"><div> {{$gandola->chofer}} </div></td>
                    <td class="table-text"><div> {{$gandola->placa}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso_neto}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso_mermado}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso_real}} </div></td>
                    <td class="table-text"><div> {{$gandola->fecha}} </div></td>
                    <td class="table-text"><div> {{$gandola->ubicacion}} </div></td>
                    
                       <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='pesos/{{$gandola->id}}'">
                        <i class="fa fa-pencil"></i> Pesos
                    </button></td>
                    <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='ubicacion/{{$gandola->cid}}'">
                        <i class="fa fa-pencil"></i> Ubicacion
                    </button></td>
                     <td><form action="{{url('pdfid')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}


    <input type="hidden"  name="cedula" class="form-control" value="" >
    <input type="hidden"  name="id" class="form-control" value="" >


 
<div class="form-group">
       <button type="submit" class='btn btn-xs'><i class="fa fa-print"></i></button>
    
</div>

</form>
           
             </td>       
                  
                    
                  @endif    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @endif
</div>
@stop