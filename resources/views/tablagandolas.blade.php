@extends('layouts.principal')

@section('content')
<div class="col-md-12">
    
     <br>
     <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Gandolas</div>
    <div class="panel-body">
    @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
     <button type="submit" class="btn btn-success btn" onclick="location.href='agregargandola'"><i class="fa fa-plus"></i>Agregar</button>
     @endif
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
       <h4><strong>Gandolas: {{count($gandol)}}</strong></h4>
        <table class="table table-striped task-table">
            <thead>
                <th>Chofer</th>
                <th>C.I.</th>
                <th>Telefono</th>
                <th>Placa</th>
                <th>Remolque</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Año</th>
                <th>Capacidad</th>
                 @if(Auth::user()->hasRole('admin'))
                <th>Acciones</th>
                @endif
            </thead>
            <tbody>
                @foreach($gandol as $gandola)
                <tr>
                    <td class="table-text"><div> {{$gandola->chofer}} </div></td>
                    <td class="table-text"><div> {{$gandola->cedula}} </div></td>
                    <td class="table-text"><div> {{$gandola->telefono}} </div></td>
                    <td class="table-text"><div> {{$gandola->placa}} </div></td>
                    <td class="table-text"><div> {{$gandola->placaremolque}} </div></td>
                    <td class="table-text"><div> {{$gandola->modelo}} </div></td>
                    <td class="table-text"><div> {{$gandola->marca}} </div></td>
                    <td class="table-text"><div> {{$gandola->color}} </div></td>
                    <td class="table-text"><div> {{$gandola->ano}} </div></td>
                    <td class="table-text"><div> {{$gandola->peso}} </div></td>
                    @if(Auth::user()->hasRole('admin'))
                       <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editargandola/{{$gandola->id}}'" style="float: left" title="Editar">
                        <i class="fa fa-pencil fa-2x"></i>
                    </button> 
                    <form action="{{url('tablagandola')}}/{{$gandola->id}}" method="post" style="float: left"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar al vehiculo PLACAS {{$gandola->placa}}, SE BORRARAN TODOS SUS REGISTROS')" title="Borrar">
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