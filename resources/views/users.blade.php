@extends('layouts.principal')


@section('content')
<div class="col-md-12">
    
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">Listado de Usuarios</div>
    <div class="panel-body">
       <form action="{{url('buscaruser')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
   
    
   
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar</button>
        </div>
 
    
    </form>
        @if(count($user)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert">{{$msj}}</div></div>
@endif
       @if (count($user)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Usuario</th>
                <th>Correo Electronico</th>
                <th>Acción</th>
            </thead>
            <tbody>
                @foreach($user as $users)
                <tr>
                    <td class="table-text"><div> {{$users->name}} </div></td>
                    <td class="table-text"><div> {{$users->email}} </div></td>
                    @if(Auth::user()->id!=$users->id)
                    <td><form action="{{url('users')}}/{{$users->id}}" method="post"> 
                    {{csrf_field()}} 
                    {{method_field ('DELETE')}} 
                    <button type="submit" class="btn btn-danger btn-xs"  onclick="return confirm('Esta Seguro de Eliminar el usuario  {{$users->name}}')">
                        <i class="fa fa-trash fa-2x"></i>
                    </button>
                    </form>
                    @endif
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