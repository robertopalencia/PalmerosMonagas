@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Listado de Gandolas en Camino</strong></div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='endestino'"><i class="fa fa-tag"></i>En destino</button>
     <br>
     <br>
      @if($gandola==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">No hay Gandolas en camino</div></div>
@endif
      @if($gandola>0)
        <table class="table table-striped task-table">
            <thead>
                
                <th>Placa</th>
                <th>Receptoria</th>
                <th>Monagas</th>
                <th>Diferencia</th>
                <th>Zulia</th>
                <th>Merma</th>
                <th>Fecha</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </thead>
            <tbody><?php $anterior=0;?>
                @foreach($gandol as $gandola)
                <tr>
                   @if($anterior!=$gandola->cid)
                   <?php $anterior=$gandola->cid; ?>
                    
                    <td class="table-text"><div> {{$gandola->placa}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso_neto}}Ton </div></td>
                    <td class="table-text"><div> {{$gandola->peso_real}}Ton</div></td>
                    <td class="table-text"><div> {{$gandola->peso_real-$gandola->peso_neto}}Ton</div></td>
                    <td class="table-text"><div> {{$gandola->peso_mermado}}Ton</div></td>
                    <td class="table-text"><div> {{number_format($gandola->peso_real-$gandola->peso_mermado, 2,'.',',')}}Ton </div></td>
                    
                    <td class="table-text"><div> {{$gandola->fecha}} </div></td>
                    <td class="table-text"><div> {{$gandola->ubicacion}} </div></td>
                    
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