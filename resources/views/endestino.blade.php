@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Listado de Gandolas en Destino</strong></div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='gandolas'"><i class="fa fa-road"></i>En Camino</button>
    
      @if($gandola==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">No hay Gandolas en camino</div></div>
@endif
      @if($gandola>0) <br><br>
       <strong>{!!$gandol->total()!!} Registros Encontrados</strong>
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
                    <td class="table-text"><div> {{$gandola->peso_neto}}Kg </div></td>
                    <td class="table-text"><div> {{$gandola->peso_real}}Kg </div></td>
                    <td class="table-text"><div> {{$gandola->peso_real-$gandola->peso_neto}}Kg </div></td>
                    <td class="table-text"><div> {{$gandola->peso_mermado}}Kg </div></td>
                    <td class="table-text"><div> {{$gandola->peso_real-$gandola->peso_mermado}}Kg </div></td>
                    
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
        {!!$gandol->render()!!}
    </div>
    </div>
    @endif
</div>
@stop