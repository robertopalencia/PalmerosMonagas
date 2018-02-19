@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Listado de Gandolas en Destino</strong></div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='gandolas'"><i class="fa fa-plus"></i>En Camino</button>
    
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
                
                    
                       <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='pesos/{{$gandola->id}}'">
                        <i class=""></i> Pesos
                    </button></td>
                    <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='ubicacion/{{$gandola->cid}}'">
                        <i class=""></i> Ubicacion
                    </button></td>
                        
                  
                    
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