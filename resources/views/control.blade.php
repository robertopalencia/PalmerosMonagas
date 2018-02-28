@extends('layouts.principal')

@section('content')

<div class="col-md-12">
    
    <br>
    <br>
    
   
    <div class="panel panel-default">
        <div class="panel-heading"><strong>CONTROL</strong></div>
    <div class="panel-body">
     
    <form action="{{url('buscarcontrolfecha')}}" method="POST" class="navbar-form navbar-left pull-right">
{{csrf_field()}}

<div class="form-group">
   
    <input type="text"  name="nombre" class="form-control" placeholder="Cedula o RIF" >
</div>


<div class="form-group">
       <button type="submit" class='btn btn-info'><i class="fa fa-search"></i> BUSCAR</button>
    
</div>
</form>    
    @if(count($controles)==0)
        <div class="col-xs-11">
<div class="alert alert-danger" role="alert"><strong>{{$msj}}</strong></div></div>
@endif
   
       @if (count($controles)>0)
        <table class="table table-striped task-table">
            <thead>
                <th>Productor</th>
                <th>Placa</th>
                <th>Tara</th>
                <th>Carga</th>
                <th>Monto</th>
                
                
            </thead>
            <tbody> 
                @foreach($controles as $control)
               
                <tr>
                  
                    <td class="table-text"><div> {{$control->nombre}} </div></td>
                    
                    <td class="table-text"><div> {{$control->placa}} </div></td>
                   
                   
                    <td class="table-text"><div> {{$control->peso}} </div></td>
                    
                    <td class="table-text"><div> {{$control->carga-$control->peso}} </div></td>
                   
                     <td class="table-text"><div> {{number_format((($control->carga-$control->peso)/1000)*$control->precio, 2,",",".")}} </div></td>
                   
                     
                </tr>
                
                @endforeach
               
                <tr>
                 <td class="table-text"><div></div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div> </div></td>
                    <td class="table-text"><div><h4><strong>Monto Total</strong> </h4></div></td>
                    <td class="table-text"><div><h4><strong> </strong></h4></div></td>
                    <td class="table-text"><div> </div></td>
                    </tr>
            </tbody>
        </table>
        @endif
       
        
    </div>
    </div>
    
</div>



@stop