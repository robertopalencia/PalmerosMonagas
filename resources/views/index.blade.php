@extends('layouts.principal')

<?php use Palma\Precio; ?>
@if(Auth::check()) 
@section('content')
 <br><br>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">PRODUCTORES <br><br></div>
                        <div class="text-huge"><h1>@foreach($productor as $var){{$var->idp}}@endforeach </h1></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                </div>
            </div>
             
               
           
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">CAMIONES <br><br></div>
                        <div class="text-huge"><h1>@foreach($camion as $var){{$var->idp}}@endforeach </h1></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-truck fa-5x"></i>
                    </div>
                </div>
            </div>
          
               
            
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">RECIBOS POR PAGAR</div>
                        <div class="text-huge"><h1>@foreach($pesaje as $var){{$var->idp}}@endforeach </h1></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                </div>
            </div>
            
               
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">USUARIOS <br><br></div>
                        <div class="text-huge"><h1><h1>@foreach($usuario as $var){{$var->idp}}@endforeach </h1></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                </div>
            </div>
            
          
        </div>
    </div>

</div>
@endif
@stop