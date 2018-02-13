@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
  @include('common.errors')

    <div class="panel panel-default">
        <div class="panel-heading">Listado de Productores</div>
    <div class="panel-body">
       
    <form action="{{url('buscarproductor')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
    
    
    
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar Productor</button>
        </div>
    
    
    </form>    
   @if(count($productor)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">{{$msj}}</div></div>
@endif
   @if (count($productor)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Productor</th>
                <th>CI</th>
                <th>RIF</th>
                <th>Nombre Juridico</th>
             
                  <th>Telefono</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($productor as $productores)
                <tr>
                    <td class="table-text"><div> {{$productores->nombre}} </div></td>
                    <td class="table-text"><div> {{$productores->cedula}} </div></td>
                    <td class="table-text"><div> {{$productores->rif}} </div></td>
                    <td class="table-text"><div> {{$productores->finca}} </div></td>
                      <td class="table-text"><div> {{$productores->telefono}} </div></td>
                      <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editarproductores/{{$productores->id}}'">
                        <i class="fa fa-pencil"></i> Editar
                    </button></td>
                    <td><form action="{{url('tablaproductores')}}/{{$productores->id}}" method="post"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Esta Seguro de Eliminar a {{$productores->nombre}}, SE BORRARAN TODOS SUS REGISTROS, CUENTAS BANCARIAS, PESAJES, RECIBOS ENTRE OTRAS COSAS')">
                        <i class="fa fa-trash"></i> Borrar
                    </button>
                    </form>
                    </td>
                      <td><form action="{{url('buscarreciboproductor')}}" method="post"> 
                    {{csrf_field()}}  
                    <input type="hidden" name="nombre" class="form-control"  value="{{$productores->cedula}}">
                    <button type="submit" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i> Visualizar
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