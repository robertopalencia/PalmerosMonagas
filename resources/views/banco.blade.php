@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    

    <div class="panel panel-default">
        <div class="panel-heading">Cuentas Bancarias</div>
    <div class="panel-body">
        <button type="submit" class="btn btn-success btn" onclick="location.href='agregarcuenta'"><i class="fa fa-plus"></i>Agregar</button>
    <form action="{{url('buscarbanco')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
      
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
  
    
    
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar Cuenta</button>
        </div>
    
    
    </form>  
    
   @if(count($banco)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">{{$msj}}</div></div>
@endif
   @if (count($banco)>0 && count($productor)>0 )
        <table class="table table-striped task-table">
            <thead>
                <th>Nombre</th>
                <th>Cedula o RIF</th>
                <th>Correo</th>
                <th>Banco</th>
                <th>Cuenta Nº</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                
                
                @foreach($productor as $productores)
                @foreach($banco as $bancos)
                  <tr>
                   @if($bancos->productor_id==$productores->id)
                   
                    @if($bancos->tipo=='Juridico')
                     <td class="table-text"><div> {{$productores->finca}} </div></td>
                    <td class="table-text"><div> {{$productores->rif}} </div></td>
                    @else 
                     <td class="table-text"><div> {{$productores->nombre}} </div></td>
                    <td class="table-text"><div> {{$productores->cedula}} </div></td>
                    @endif
                    <td class="table-text"><div> {{$productores->correo}} </div></td>
                     <td class="table-text"><div> {{$bancos->banco}} </div></td>
                    <td class="table-text"><div> {{$bancos->cuenta}} </div></td>
                    <td class="table-text"><div> {{$bancos->tipocuenta}} </div></td>
                
                      <td><button type="submit" class="btn btn-warning btn-xs" onclick="location.href='editarcuenta/{{$bancos->id}}'">
                        <i class="fa fa-pencil"></i>Editar
                    </button></td>
                    <td><form action="{{url('banco')}}/{{$bancos->id}}" method="post"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar la cuenta {{$bancos->tipocuenta}} de {{$bancos->banco}} de {{$productores->nombre}}')">
                        <i class="fa fa-trash"></i>Borrar
                    </button>
                    </form> </td>
                    @endif
                   </tr>
                @endforeach
                @endforeach
                
               
                   
                    
                        
                   
                  
                
                
            </tbody>
        </table>
    </div>
    </div>
    @endif
</div>
@stop