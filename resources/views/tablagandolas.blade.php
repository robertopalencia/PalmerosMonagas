@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Gandolas</div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='agregargandola'"><i class="fa fa-plus"></i>Agregar</button>
     <form action="{{url('buscargandola')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
   
    
 
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar Gandola</button>
        </div>
 
    
    </form>
      @if(count($gandol)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">{{$msj}}</div></div>
@endif
      @if (count($gandol)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Chofer</th>
                <th>Cedula de Identidad</th>
                <th>Telefono</th>
                <th>Placa</th>
                <th>Capacidad de Carga</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($gandol as $gandola)
                <tr>
                    <td class="table-text"><div> {{$gandola->chofer}} </div></td>
                    <td class="table-text"><div> {{$gandola->cedula}} </div></td>
                    <td class="table-text"><div> {{$gandola->telefono}} </div></td>
                    <td class="table-text"><div> {{$gandola->placa}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso}} </div></td>
                    
                       <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editargandola/{{$gandola->id}}'">
                        <i class="fa fa-pencil"></i>Editar
                    </button></td>
                    <td><form action="{{url('tablagandola')}}/{{$gandola->id}}" method="post"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar al vehiculo PLACAS {{$gandola->placa}}, SE BORRARAN TODOS SUS REGISTROS')">
                        <i class="fa fa-trash"></i>Borrar
                    </button>
                    </form>
                    </td>
                    
                  
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @endif
</div>
@stop