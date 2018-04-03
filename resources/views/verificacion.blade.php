@extends('layouts.principal')


@section('content')
    <h1>Pesaje</h1> 
     
@include('common.errors')
@if(session()->has('msj'))
    <div class="col-xs-11">
        <form action="{{url('pdfcarga')}}" method="POST" class="navbar-form navbar-left">
{{csrf_field()}}
            <div class="alert alert-success" role="alert">{{session('msj')}}
                <input type="hidden" name="cedula" class="form-control" value="{{session('cedula')}}">
                <input type="hidden" name="cod" class="form-control" value="{{session('cod')}}">
                <input type="hidden" name="chofer" class="form-control" value="{{session('chofer')}}">
                <input type="hidden" name="peso" class="form-control" value="{{session('peso')}}">
                <input type="hidden" name="carga" class="form-control" value="{{session('carga')}}">
                <input type="hidden" name="precio" class="form-control" value="{{session('precio')}}">
                <input type="hidden" name="preciocontado" class="form-control" value="{{session('preciocontado')}}">
                <input type="hidden" name="preciocredito" class="form-control" value="{{session('preciocredito')}}">
                <input type="hidden" name="rif" class="form-control" value="{{session('rif')}}">
                <input type="hidden" name="nombre" class="form-control" value="{{session('nombre')}}">
                <input type="hidden" name="fecha" class="form-control" value="{{session('fecha')}}">
                <input type="hidden" name="placa" class="form-control" value="{{session('placa')}}">
                <input type="hidden" name="descuento" class="form-control" value="{{session('descuento')}}">
                <input type="hidden" name="entrada" class="form-control" value="{{session('entrada')}}">
                <input type="hidden" name="salida" class="form-control" value="{{session('salida')}}">
                <input type="hidden" name="id" class="form-control" value="{{session('id')}}">
                <input type="hidden" name="modelo" class="form-control" value="{{session('modelo')}}">
                <input type="hidden" name="marca" class="form-control" value="{{session('marca')}}">
                <input type="hidden" name="ano" class="form-control" value="{{session('ano')}}">
                
                <button type="submit" class='btn btn'>
                    <i class="fa fa-print"></i>  
                    <strong>Imprimir</strong>
                </button>
            </div>
        </form> 
    </div>
@endif
@if(session()->has('msj2'))
    <div class="alert alert-danger" role="alert">
        {{session('msj2')}}
    </div>
@endif
@if(session()->has('msj3'))
    <div class="alert alert-danger" role="alert">
        {{session('msj3')}}
    </div>
@endif
   {{ Form::open(array('url' => 'verificacion')) }}
   {{csrf_field()}}
      <div class="col-xs-5">
            <div class="form-group">
                <label for="rif" class="control-label">RIF o COD del Productor</label>
                <div class="input-group">
                    <select name="letra" class="form-control" required>
                     <option value="">RIF</option>
                     <option value="C">C</option>
                     <option value="E">E</option>
                     <option value="G">G</option>
                     <option value="J">J</option>
                     <option value="P">P</option>
                     <option value="V">V</option>
                     <option value="">COD</option>
                     <option value="PH">PH</option>
                     <option value="PVL">PVL</option>
                     <option value="PZ">PZ</option>
                     <option value="PC">PC</option>
                     <option value="PA">PA</option>
                     <option value="PV">PV</option>
                     <option value="PCR">PCR</option>
                     <option value="PPJ">PPJ</option>
                     <option value="PSA">PSA</option>
                     <option value="PEB">PEB</option>
                    </select>
                    <span class="input-group-addon">-</span> 
                <input type="number" name="rif" class="form-control" value="{{old('rif')}}" required>
                </div>
            </div>
        </div>
          <div class="col-xs-5">
            <div class="form-group">
                <br>
                 <button type="submit" class='btn btn-info'>
                     <i class="fa fa-plus"></i> Verificar
                 </button>
            </div>
        </div>
    {{ Form::close() }}
       @if($idgandola>0)
         <div class="col-xs-5">
            <div class="form-group">
                       @if(session()->has('idcarga'))
             
                <form action="{{url('editargandolas')}}/{{session('idcarga')}}" method="post" > 
                    {{csrf_field()}} 
                    {{method_field ('PUT')}} 
                     <strong> {{session('pesoneto')}}/{{session('gandolapeso')}} Ton. Cargados en la Gandola Placas {{session('placagandola')}}</strong>
                       <button type="submit" class="btn btn-danger btn"  onclick="return confirm('¿Esta Seguro de que la gandola ha sido cargada completamente?')">
                        <i class="fa fa-stop"></i>
                    </button>
                   
                    </form>
                   
                @else
                               <form action="{{url('editargandolas')}}/{{$idcarga}}" method="post" > 
                    {{csrf_field()}} 
                    {{method_field ('PUT')}} 
                    <strong> {{number_format($pesoneto, 2, ",",".")}} Ton. de {{number_format($gandolapeso, 2, ",",".")}} Ton. Gandola Placas {{$placagandola}}</strong>
                    <button type="submit" class="btn btn-danger btn"  onclick="return confirm('¿Esta Seguro de que la gandola ha sido cargada completamente?')">
                        <i class="fa fa-stop"></i>
                    </button>
                    
                    </form>
                   
                @endif
                   </div>
        </div>
        @endif
@stop