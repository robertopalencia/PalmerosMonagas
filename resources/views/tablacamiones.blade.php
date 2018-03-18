@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Vehiculos</div>
    <div class="panel-body">
    @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
     <button type="submit" class="btn btn-success btn" onclick="location.href='caagregar'"><i class="fa fa-plus"></i>Agregar</button>
     @endif
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
                <th>C.I.</th>
                 @if(Auth::user()->hasRole('admin'))
                <th>Telefono</th>
                @endif
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Año</th>
                <th>Tara</th>
                @if(Auth::user()->hasRole('admin'))
                <th>Acciones</th>
                @endif
            </thead>
            <tbody>
                @foreach($camion as $camiones)
                <tr>
                    <td class="table-text"><div> {{$camiones->nombre}} </div></td>
                    <td class="table-text"><div> {{$camiones->cedula}} </div></td>
                     @if(Auth::user()->hasRole('admin'))
                    <td class="table-text"><div> {{$camiones->telefono}} </div></td>
                    @endif
                    <td class="table-text"><div> {{$camiones->placa}} </div></td>
                    <td class="table-text"><div> {{$camiones->marca}} </div></td>
                    <td class="table-text"><div> {{$camiones->modelo}} </div></td>
                    <td class="table-text"><div> {{$camiones->color}} </div></td>
                    <td class="table-text"><div> {{$camiones->ano}} </div></td>
                    <td class="table-text"><div> {{$camiones->peso}} </div></td>
                    @if(Auth::user()->hasRole('admin'))
                    <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editarcamiones/{{$camiones->id}}'" style="float: left">
                        <i class="fa fa-pencil fa-2x"></i>
                    </button>
                    <form action="{{url('tablacamiones')}}/{{$camiones->id}}" method="post" style="float: left"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar al vehiculo PLACAS {{$camiones->placa}}, SE BORRARAN TODOS SUS REGISTROS')">
                        <i class="fa fa-trash fa-2x"></i>
                    </button>
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