@extends('layouts.principal')


@section('content')
    <h1>Pesaje</h1> 
     
@include('common.errors')
@if(session()->has('msj'))
    <div class="col-xs-11">
        <form action="{{url('pdfcarga')}}" method="POST" class="navbar-form navbar-left">
{{csrf_field()}}
            <div class="alert alert-success" role="alert">{{session('msj')}}
                <input type="hidden" name="peso" class="form-control" value="{{session('peso')}}">
                 <input type="hidden" name="descuento" class="form-control" value="{{session('descuento')}}">
                <input type="hidden" name="carga" class="form-control" value="{{session('carga')}}">
                <input type="hidden" name="precio" class="form-control" value="{{session('precio')}}">
                <input type="hidden" name="cedula" class="form-control" value="{{session('cedula')}}">
                <input type="hidden" name="nombre" class="form-control" value="{{session('nombre')}}">
                <input type="hidden" name="placa" class="form-control" value="{{session('placa')}}">
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
   {{ Form::open(array('url' => 'agregarcarga')) }}
   {{csrf_field()}}
      
        <div class="col-xs-5">
            <div class="form-group">
                <label for="carga" class="control-label">Peso Bruto</label>
                <input type="number" step="0.01" name="carga" class="form-control" value="{{old('carga')}}" required >
            </div>
        </div>
        <div class="col-xs-5">
            <div class="form-group">
                <label for="tara" class="control-label">Tara</label>
                <input type="number" step="0.01" name="tara" class="form-control" value="{{old('tara')}}" required >
            </div>
        </div>
       
        <div class="col-xs-5">
            <div class="form-group">
                <label for="placa" class="control-label">Placa Camion</label>
                <input type="text" name="placa" class="form-control" value="{{old('placa')}}" required>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="form-group">
                <label for="rif" class="control-label">RIF</label>
                <div class="input-group">
                    <select name="letra" class="form-control" required>
                     <option value=""></option>
                     <option value="C">C</option>
                     <option value="E">E</option>
                     <option value="G">G</option>
                     <option value="J">J</option>
                     <option value="P">P</option>
                     <option value="V">V</option>
                    </select>
                    <span class="input-group-addon">-</span> 
                <input type="number" name="rif" class="form-control" value="{{old('rif')}}" required>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="form-group">
                <label for="precio" class="control-label">Tipo de Precio</label>
                
                    <select name="precio" class="form-control" required>
                     <option value=""></option>
                     <option value="contado">Contado</option>
                     <option value="credito">Credito</option>
                    </select>
            </div>
        </div>
    <div class="col-xs-5">
            <div class="form-group">
                <label for="descripcion" class="control-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}" required>
            </div>
        </div>
     @if($idgandola==0)
        <div class="col-xs-5">
            <div class="form-group">
                <label for="gandola" class="control-label">Placa Gandola</label>
                <input type="text" name="gandola" class="form-control" value="{{old('gandola')}}" required>
            </div>
        </div>
        @else
        @if(session()->has('placagandola'))
        <input type="hidden" name="gandola" class="form-control" value="{{session('placagandola')}}">
        @else
         <input type="hidden" name="gandola" class="form-control" value="{{$placagandola}}">
         @endif
        @endif
         
        <div class="col-xs-5">
            <div class="form-group">
                <br>
                 <button type="submit" class='btn btn-info'>
                     <i class="fa fa-plus"></i> Cargar Pesaje
                 </button>
            </div>
        </div>
    {{ Form::close() }}
       @if($idgandola>0)
         <div class="col-xs-5" style="Float: left">
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