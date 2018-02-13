@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Vehiculos</div>
    <div class="panel-body">
     <button type="submit" class="btn btn-success btn" onclick="location.href='caagregar'"><i class="fa fa-plus"></i>Agregar</button>
     <form action="{{url('buscarcamion')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
   
    
 
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar Camion</button>
        </div>
 
    
    </form>
      @if(count($camion)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">{{$msj}}</div></div>
@endif
      @if (count($camion)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Chofer</th>
                <th>Cedula de Identidad</th>
                <th>Telefono</th>
                <th>Placa</th>
                <th>Peso sin Carga</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($camion as $camiones)
                <tr>
                    <td class="table-text"><div> {{$camiones->nombre}} </div></td>
                    <td class="table-text"><div> {{$camiones->cedula}} </div></td>
                    <td class="table-text"><div> {{$camiones->telefono}} </div></td>
                    <td class="table-text"><div> {{$camiones->placa}} </div></td>
                    <td class="table-text"><div> {{$camiones->peso}} </div></td>
                    
                       <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editarcamiones/{{$camiones->id}}'">
                        <i class="fa fa-pencil"></i>Editar
                    </button></td>
                    <td><form action="{{url('tablacamiones')}}/{{$camiones->id}}" method="post"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar al vehiculo PLACAS {{$camiones->placa}}, SE BORRARAN TODOS SUS REGISTROS')">
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