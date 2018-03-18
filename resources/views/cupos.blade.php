@extends('layouts.principal')


@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    

    <div class="panel panel-default">
        <div class="panel-heading">Cupos</div>
    <div class="panel-body">
         @if (count($cupo)==0 && count($cupos)>0 )
           <button type="submit" class="btn btn-success btn" onclick="location.href='cupos'"><i class="fa fa-arrow-left"></i>Regresar</button>
         @endif
         @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
        <button type="submit" class="btn btn-success btn" onclick="location.href='agregarcupos'"><i class="fa fa-plus"></i>Agregar</button>
        @endif
         @if(Auth::user()->hasRole('admin'))
    <form action="{{url('buscarcupos')}}" method="post" class="navbar-form navbar-left pull-right">
     {{csrf_field()}}
    
       
        <div class="form-group">
            <input type="date" name="nombre" class="form-control" placeholder="Buscar">
        </div>
    
    
   
        <div class="form-group">
            <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> Buscar</button>
        </div>
   
    
    </form>  
    <br>  
  @if(count($cupo)==0)
    @if(count($cupos)==0)
    <br><br>
<div class="alert alert-danger" role="alert">{{$msj}}</div>
@endif
  @endif
   @if (count($cupo)>0)
      
        <table class="table table-striped task-table">
            <thead>
                <th>Fecha</th>
                <th>Kilogramos</th>
                <th>Cupos</th>
            </thead>
            <tbody>
                @foreach($cupo as $cupos)
 @if($cupos->fecha>=$fecha)
                     <tr>
                     <?php $formato=date_create("$cupos->fecha");?>
                     <td class="table-text"><div> {{date_format($formato, "d-m-Y")}} </div></td>
                    <td class="table-text"><div> </div> {{$cupos->speso}}</td>
                    <td class="table-text"><div> {{$cupos->cfecha}} </div></td>
                   </tr>
                
 @endif
                @endforeach

                
            </tbody>
        </table>
       
    </div>
    </div>
    @else 
      @if (count($cupos)>0)
    <br><br><h4>  <strong>Fecha:</strong> {{date_format($fecha, 'd-m-Y')}}</h4>
     <table class="table table-striped task-table">
            <thead>
                <th>Productor</th>
                <th>Cedula de Identidad</th>
                <th>Kilogramos</th>
                <th>Telefono</th>
            </thead>
            <tbody>
                @foreach($cupos as $cupo)

                     <tr>
                     <td class="table-text"><div> {{$cupo->nombre}} </div></td>
                    <td class="table-text"><div> </div> {{$cupo->cedula}}</td>
                     <td class="table-text"><div> </div> {{$cupo->peso}}</td>
                    <td class="table-text"><div> {{$cupo->telefono}} </div></td>
                    
                   </tr>
                

                @endforeach
            </tbody>
        </table>
        <div class="navbar-form navbar-left pull-right"><h3><strong>PESO TOTAL {{$peso}}Kg</strong></h3></div>
    </div>
    </div>
     @endif
    @endif
    @endif
</div>
@stop